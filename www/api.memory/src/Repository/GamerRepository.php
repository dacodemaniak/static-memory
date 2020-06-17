<?php
namespace Memory\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\Mapping\ClassMetadata;
use Doctrine\ORM\EntityManagerInterface;
use Memory\Entity\Gamer;

class GamerRepository extends EntityRepository
{

    public function __construct(EntityManagerInterface $em, ClassMetadata $class){
        parent::__construct($em, $class);
    }
    
    /**
     * Gets the 5 last gamers from the database
     * @return array
     */
    public function lastGamers(): array {
        $queryBuilder = $this->_em->createQueryBuilder();
        
        $queryBuilder
            ->select('g')
            ->from(Gamer::class, 'g')
            ->orderBy('g.id', 'DESC')
            ->setFirstResult(0)
            ->setMaxResults(5);
        $query = $queryBuilder->getQuery();
        
        return $query->execute();
    }
}

