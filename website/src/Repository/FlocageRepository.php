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

    // /**
    //  * @return Flocage[] Returns an array of Flocage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Flocage
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
