<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Symfony\Component\HttpFoundation\Response;


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

        $pdp = $cgps->GetDataPartCount();

        return new Response( $cgps->BuildResponseHTTP( $pdp ), 200, array() );


    }

}
