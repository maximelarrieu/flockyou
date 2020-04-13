<?php

namespace App\Repository;

use App\Entity\Command;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Command|null find($id, $lockMode = null, $lockVersion = null)
 * @method Command|null findOneBy(array $criteria, array $orderBy = null)
 * @method Command[]    findAll()
 * @method Command[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommandRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Command::class);
    }

    public function findLastUserCommand($user, $limit) {
        return $this->createQueryBuilder('command')
            ->innerJoin('command.user', 'user')
            ->where('command.user = :user')
            ->orderBy('command.createdAt', 'DESC')
            ->setParameters([
                'user' => $user
            ])
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function getUserCommands($user) {
        return $this->createQueryBuilder('command')
            ->innerJoin('command.user', 'user')
            ->where('command.user = :user')
            ->orderBy('command.createdAt', 'DESC')
            ->setParameters([
                'user' => $user
            ])
            ->getQuery()
            ->getResult();
    }


    // /**
    //  * @return Command[] Returns an array of Command objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Command
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
