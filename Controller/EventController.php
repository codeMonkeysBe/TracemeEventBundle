<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
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

        $pdp = $this->storeEventFromCgpsData( $cgps, $extraData );

        return new Response( $cgps->BuildResponseHTTP( $pdp ), 200, array() );


    }

    protected function storeEventFromCgpsData( $cgps, $extraData )
    {

        $em = $this->get('doctrine')->getManager();
        
        $processedDataParts = 0;

        for( ;$processedDataParts < $cgps->GetDataPartCount(); $processedDataParts++ ){

            if(!$cgps->SelectDataPart($processedDataParts) || !$cgps->IsValid())
            {
                continue;
            }

            $event = new Event();

            $event->setDate( new DateTime( '@' . $cgps->GetUtcTime() ) );
            $event->setImei( $cgps->GetImei() );
            $event->setSwitch( $cgps->GetSwitch() );
            $event->setEventid( $cgps->CanGetEventID() ? $cgps->GetEventID() : 0 );
            $event->setLatitude( $cgps->GetLatitudeSmall() );
            $event->setLongitude( $cgps->GetLongitudeSmall() );
            $event->setIo( $cgps->GetIO() );
            $event->setData( $cgps->GetBinaryData() );
            $event->setExtra( $extraData );

            $em->persist( $event );

        }

        $em->flush();

        return $processedDataParts;

    }

}
