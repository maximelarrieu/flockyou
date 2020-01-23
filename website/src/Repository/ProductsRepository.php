<?php

namespace App\Repository;

use App\Entity\Products;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Products|null find($id, $lockMode = null, $lockVersion = null)
 * @method Products|null findOneBy(array $criteria, array $orderBy = null)
 * @method Products[]    findAll()
 * @method Products[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Products::class);
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
            ->where('l.league_name = :league')
            ->setParameters([
                'league' => $league
            ])
            ->getQuery()
            ->getResult();
    }


}
