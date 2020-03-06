<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * @param string $league
     * @return mixed
     */
    public function getProductFromLeague(string $league)
    {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.team', 't')
            ->innerJoin('t.league', 'l')
            ->where('l.name = :league')
            ->andWhere('p.size is null')
            ->setParameters([
                'league' => $league
            ])
            ->getQuery()
            ->getResult();
    }

    /**
     * @param string $cart
     * @return mixed
     */
    public function getProductFromCart(string $cart) {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.carts', 'c')
            ->where('p in :cart')
            ->setParameters([
                'cart' => $cart
            ])
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
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
    public function findOneBySomeField($value): ?Product
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
