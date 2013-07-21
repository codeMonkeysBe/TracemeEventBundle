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

        $cgpsService = $this->get('cgps_service');

        $cgps =  $cgpsService->Cgps();
        $cgps->ClearResponseActionMembers();

        if( !$cgps->SetHttpData( $moduleDataString ) ){
            return new Response( $cgps->BuildResponseHTTP(0) );
        }

        $method = $request->getMethod();

        if( $method === 'POST' ){

            $extraData = $this->get("request")->getContent();

            if( $cgps->CanGetExtraDataSize() && ( $cgps->GetExtraDataSize()!=strlen( $extraData ) ) ){
                return new Response( $cgps->BuildResponseHTTP(0) );
            }

        }

        $pdp = $cgps->GetDataPartCount();

        return new Response( $cgps->BuildResponseHTTP( $pdp ) );


    }

}
