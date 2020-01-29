<?php

namespace App\Repository;

use App\Entity\PasswordEdit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PasswordEdit|null find($id, $lockMode = null, $lockVersion = null)
 * @method PasswordEdit|null findOneBy(array $criteria, array $orderBy = null)
 * @method PasswordEdit[]    findAll()
 * @method PasswordEdit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PasswordEditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PasswordEdit::class);
    }

    // /**
    //  * @return PasswordEdit[] Returns an array of PasswordEdit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PasswordEdit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
