<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\Entity;

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
 * @ORM\Entity
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="imei", type="bigint")
     */
    private $imei;

    /**
     * @var integer
     *
     * @ORM\Column(name="switch", type="smallint")
     */
    private $switch;

    /**
     * @var integer
     *
     * @ORM\Column(name="eventid", type="smallint")
     */
    private $eventid;

    /**
     * @var integer
     *
     * @ORM\Column(name="latitude", type="bigint")
     */
    private $latitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="longitude", type="bigint")
     */
    private $longitude;

    /**
     * @var integer
     *
     * @ORM\Column(name="io", type="smallint")
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
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set extra
     *
     * @param string $extra
     * @return Event
     */
    public function setExtra($extra)
    {
        $this->extra = $extra;
    
        return $this;
    }

    /**
     * Get extra
     *
     * @return string 
     */
    public function getExtra()
    {
        return $this->extra;
    }
}
