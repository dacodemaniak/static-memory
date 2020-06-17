<?php
namespace Memory\Repository;

/**
 * @name GamerRepository
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Repository
 * @abstract Gamer repository
 */

use Doctrine\Common\Persistence\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class GamerRepository extends EntityRepository
{
    
    public function __construct(EntityManagerInterface $em, ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
    
    /**
     * Get a gamer from his ID (sample purpose only)
     * @param int $id
     * @return unknown
     */
    public function findById(int $id) {
        return $this->find($id);
    }
}