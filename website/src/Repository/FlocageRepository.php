<?php

namespace App\Repository;

use App\Entity\Flocage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Flocage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Flocage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Flocage[]    findAll()
 * @method Flocage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */

class FlocageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Flocage::class);
    }

    public function getFlocageFromTeam($team) {
        return $this->createQueryBuilder('flocage')
            ->innerJoin('flocage.team', 'team')
            ->where('team.name = :team')
            ->setParameters([
                'team' => $team
            ])
            ->getQuery()
            ->getResult();
    }

    public function getFlocageProduct(string $teamName) {
         return $this->createQueryBuilder('f')
            ->innerJoin('f.team', 't')
            ->innerJoin('t.products', 'p')
            ->where('t.name = :team')
            ->setParameters([
                'team' => $teamName
            ])
            ->getQuery()
             ->getResult()
         ;
    }
}
