<?php
namespace Memory\Service;

/**
 * @name GamerService
 * @author IDea Factory (jean-luc.a@ideafactory.fr) - June 2020
 * @version 1.0.0
 * @category Service
 * @abstract Obfuscate Doctrine complexity with a Facade
 */

use Memory\Common\ORM\EntityManager as EntityManager;
use Memory\Entity\Gamer;

class GamerService {
    /**
     * Global Doctrine Entity Manager (persistence and more...)
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;
    
    /**
     * Gamer repository (interface between physical database and our own logic)
     * @var Memory\Repository\GamerRepository
     */
    private $repository;
    
    public function __construct(){
        $this->entityManager = EntityManager::getEntityManager()->getManager();
        $this->repository = EntityManager::getEntityManager()->getRepository(Gamer::class);
    }
    
    /**
     * Return all last five gamers from the database
     * @return array
     */
    public function all(): array {
        $gamers = $this->repository->lastGamers();
        
        $array = [];
        
        foreach($gamers as $gamer) {
            $array[] = [
                "id" => $gamer->getId(),
                "name" => $gamer->getName()
            ];
        }
        
        return $array;
    }
    
    public function save(Gamer $gamer): Gamer {
        $this->entityManager->persist($gamer);
        $this->entityManager->flush(); // Effectively close the transaction with a commit
        
        return $gamer;
    }
}

