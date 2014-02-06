<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;
use CodeMonkeys\IntelliTrail\Bundle\EventBundle\Entity\Event;


class EventController extends Controller
{
    /**
     * @Route("/in/{moduleDataString}")
     * @Method({"GET", "POST"})
     */
    public function inAction( $moduleDataString )
    {

        $request        = $this->get('request');
        $cgpsService    = $this->get('cgps_service');
        $extraData      = ''; 

        $cgps =  $cgpsService->Cgps();
        $cgps->ClearResponseActionMembers();

        if( !$cgps->SetHttpData( $moduleDataString ) ){
            return new Response( $cgps->BuildResponseHTTP(0), 200, array() );
        }

        $method = $request->getMethod();

        if( $method === 'POST' ){

            $extraData = $request->getContent();

            if( $cgps->CanGetExtraDataSize() && ( $cgps->GetExtraDataSize()!=strlen( $extraData ) ) ){
                return new Response( $cgps->BuildResponseHTTP(0), 200, array());
            }

        }

        $processedDataParts = $this->storeEventFromCgpsData( $cgps, $extraData );

        return new Response( $cgps->BuildResponseHTTP( $processedDataParts ), 200, array() );


    }

    protected function storeEventFromCgpsData( $cgps, $extraData )
    {

        $em         = $this->get('doctrine')->getManager();
        $deviceRepo = $this->getDoctrine()->getRepository('ApiBundle:Device');
        
        $processedDataParts = 0;

        for( ;$processedDataParts < $cgps->GetDataPartCount(); $processedDataParts++ ){

            if(!$cgps->SelectDataPart($processedDataParts) || !$cgps->IsValid())
            {
                continue;
            }

            $event = new Event();

            $event->setDate( new \DateTime( $cgps->GetUtcTimeMySQL() ) );
            $event->setImei( $cgps->GetImei() );
            $event->setSwitch( $cgps->GetSwitch() );
            $event->setEventid( $cgps->CanGetEventID() ? $cgps->GetEventID() : 0 );
            $event->setLatitude( $cgps->GetLatitudeSmall() );
            $event->setLongitude( $cgps->GetLongitudeSmall() );
            $event->setIo( $cgps->GetIO() );
            $event->setData( $cgps->GetBinaryData() );
            $event->setExtra( $extraData );
            $event->setDevice( $deviceRepo->getDeviceForPropertyValue( 'imei', $event->getImei() ) );

            $em->persist( $event );

        }

        try {
            $em->flush();
        }catch ( \Exception $e ){
        }

        return $processedDataParts;

    }

    /**
     * @Route("/out/{records}", defaults={"records" = 20})
     * @Template()
     */
    public function outAction( $records )
    {

        $cgpsService    = $this->get('cgps_service');

        $cgps =  $cgpsService->Cgps();

        $em = $this->get('doctrine')->getManager();

        $query = $em->createQuery( 'SELECT e FROM EventBundle:Event e ORDER BY e.date DESC' );
        
        $query->setMaxResults( $records );

        $events = $query->getResult();

        return array( 'events' => $events );

    }





}
