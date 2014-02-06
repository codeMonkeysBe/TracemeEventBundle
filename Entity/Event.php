<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\Entity;

use JMS\Serializer\Annotation as JMS;

use Doctrine\ORM\Mapping as ORM;

/**
 * Event
 *
 * @ORM\Table( 
     * indexes={ 
            * @ORM\Index( name="date", columns={"date"} ), 
            * @ORM\Index( name="imei", columns={"imei"} ), 
            * @ORM\Index( name="switch", columns={"switch"} ), 
            * @ORM\Index( name="eventid", columns={"eventid"} ) 
         * } 
     * )
     *
 * @ORM\Entity(repositoryClass="CodeMonkeys\IntelliTrail\Bundle\EventBundle\Entity\EventRepository")
 * @JMS\ExclusionPolicy("all")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\CodeMonkeys\IntelliTrail\Bundle\ApiBundle\Entity\Device", inversedBy="events")
     */
    private $device;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     * @JMS\Expose
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="imei", type="bigint")
     * @JMS\Expose
     */
    private $imei;

    /**
     * @var integer
     *
     * @ORM\Column(name="switch", type="smallint")
     * @JMS\Expose
     */
    private $switch;

    /**
     * @var integer
     *
     * @ORM\Column(name="eventid", type="integer")
     * @JMS\Expose
     */
    private $eventid;

    /**
     * @var integer
     *
     * @ORM\Column(name="latitude", type="bigint")
     * @JMS\Expose
     */
    private $latitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="longitude", type="bigint")
     * @JMS\Expose
     */
    private $longitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="io", type="smallint")
     * @JMS\Expose
     */
    private $io;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob")
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="extra", type="blob")
     */
    private $extra;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Event
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set imei
     *
     * @param integer $imei
     * @return Event
     */
    public function setImei($imei)
    {
        $this->imei = $imei;
    
        return $this;
    }

    /**
     * Get imei
     *
     * @return integer 
     */
    public function getImei()
    {
        return $this->imei;
    }

    /**
     * Set switch
     *
     * @param integer $switch
     * @return Event
     */
    public function setSwitch($switch)
    {
        $this->switch = $switch;
    
        return $this;
    }

    /**
     * Get switch
     *
     * @return integer 
     */
    public function getSwitch()
    {
        return $this->switch;
    }

    /**
     * Set eventid
     *
     * @param integer $eventid
     * @return Event
     */
    public function setEventid($eventid)
    {
        $this->eventid = $eventid;
    
        return $this;
    }

    /**
     * Get eventid
     *
     * @return integer 
     */
    public function getEventid()
    {
        return $this->eventid;
    }

    /**
     * Set latitude
     *
     * @param integer $latitude
     * @return Event
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    
        return $this;
    }

    /**
     * Get latitude
     *
     * @return integer 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param integer $longitude
     * @return Event
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    
        return $this;
    }

    /**
     * Get longitude
     *
     * @return integer 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set io
     *
     * @param integer $io
     * @return Event
     */
    public function setIo($io)
    {
        $this->io = $io;
    
        return $this;
    }

    /**
     * Get io
     *
     * @return integer 
     */
    public function getIo()
    {
        return $this->io;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return Event
     */
    public function setData($data)
    {
        $this->data = bin2hex( $data );
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return hex2bin( $this->data );
    }

    /**
     * Set extra
     *
     * @param string $extra
     * @return Event
     */
    public function setExtra($extra)
    {
        $this->extra = bin2hex( $extra );
    
        return $this;
    }

    /**
     * Get extra
     *
     * @return string 
     */
    public function getExtra()
    {
        return hex2bin( $this->extra );
    }

    public function getLat()
    {
        $LatitudeSmall = $this->getLatitude();
        if(($LatitudeSmall>0)&&($LatitudeSmall>>31)) $LatitudeSmall=-(0x7FFFFFFF-($LatitudeSmall&0x7FFFFFFF))-1;
        return (float)$LatitudeSmall/(float)600000;
    }

    public function getLong()
    {
        $LongitudeSmall = $this->getLongitude();
        if(($LongitudeSmall>0)&&($LongitudeSmall>>31)) $LongitudeSmall=-(0x7FFFFFFF-($LongitudeSmall&0x7FFFFFFF))-1;
        return (float)$LongitudeSmall/(float)600000;
    }




    /**
     * Set device
     *
     * @param \CodeMonkeys\IntelliTrail\Bundle\ApiBundle\Entity\Device $device
     * @return Event
     */
    public function setDevice(\CodeMonkeys\IntelliTrail\Bundle\ApiBundle\Entity\Device $device = null)
    {
        $this->device = $device;
    
        return $this;
    }

    /**
     * Get device
     *
     * @return \CodeMonkeys\IntelliTrail\Bundle\ApiBundle\Entity\Device 
     */
    public function getDevice()
    {
        return $this->device;
    }
}
