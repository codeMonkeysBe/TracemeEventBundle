<?php

namespace CodeMonkeys\IntelliTrail\Bundle\EventBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * EventRepository
 */
class EventRepository extends EntityRepository
{

    public function getEventsBetween( \DateTime $start, \DateTime $end, array $deviceIds )
    {

        return $this->getEntityManager()
            ->createQuery( "SELECT e FROM EventBundle:Event e WHERE e.date BETWEEN :start AND :end" )
            ->setParameter("start", $start)
            ->setParameter("end", $end)
            ->getResult();

    }

}
