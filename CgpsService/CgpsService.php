<?php
namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\CgpsService;

require( __DIR__ . DIRECTORY_SEPARATOR . 'cgps.php' );

class CgpsService {

    public function Cgps()
    {
        return new \CGPS();
    }

    public function getCgpsSettings()
    {
    }

}
