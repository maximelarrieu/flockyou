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
            ->orderBy('t.name', 'ASC')
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
    public function getProductFromCart($cart) {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.carts', 'c')
            ->where('c = :cart')
            ->setParameters([
                'cart' => $cart
            ])
            ->getQuery()
            ->getResult();
    }

    public function getProductFromTeam($team) {
        return $this->createQueryBuilder('p')
            ->innerJoin('p.team', 't')
            ->where('t.name = :team')
            ->setParameters([
                'team' => $team
            ])
            ->orderBy('p.state')
            ->getQuery()
            ->getResult();
    }

    public function findBestProducts($limit) {
        return $this->createQueryBuilder('p')
                    ->join('p.comments', 'c')
                    ->select('p as products, AVG(c.rating) as avgRatings')
                    ->groupBy('p')
                    ->orderBy('avgRatings', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }

    public function findRecentsProducts($limit) {
        return $this->createQueryBuilder('p')
                    ->select('p as products')
                    ->groupBy('p')
                    ->orderBy('p.createdAt', 'DESC')
                    ->setMaxResults($limit)
                    ->getQuery()
                    ->getResult();
    }
}
