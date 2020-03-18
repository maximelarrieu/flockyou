<?php

namespace App\Repository;

use App\Entity\Team;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Team|null find($id, $lockMode = null, $lockVersion = null)
 * @method Team|null findOneBy(array $criteria, array $orderBy = null)
 * @method Team[]    findAll()
 * @method Team[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeamRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Team::class);
    }

    public function createAlphabeticalQueryBuilder() {
        return $data = $this->createQueryBuilder('team')
                    ->orderBy('team.name', 'ASC');
    }

    public function getTeamFromLeague(string $league_name) {
        return $this->createQueryBuilder('team')
            ->innerJoin('team.league', 'league')
            ->where('league.name = :league_name')
            ->setParameters([
                'league_name' => $league_name
            ])
            ->getQuery()
            ->getResult();
    }

    public function getTeam($team) {
        return $data = $this->createQueryBuilder('team')
//                    ->innerJoin('team.flocages', 'flocage')
                    ->where('team.name = :team')
                    ->setParameters([
                        'team' => $team
                    ])
                    ->getQuery()
                    ->getResult();
    }
}
