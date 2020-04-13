<?php

namespace App\Service;



use Doctrine\Persistence\ObjectManager;

class StatsService {
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function getStats() {
        $users = $this->getUsersCount();
        $products = $this->getProductsCount();
        $comments = $this->getCommentsCount();
        $commands = $this->getCommandsCount();
        $recentsCommands = $this->getRecentsCommands();
        $totaux = $this->getTotaux();
        $recentsTotaux = $this->getRecentsTotaux();
        $avgComments = $this->getAvgComments();

        return compact('users', 'products', 'comments', 'commands', 'recentsCommands', 'totaux', 'recentsTotaux', 'avgComments');
    }

    public function getUsersCount() {
        return $this->manager->createQuery('SELECT COUNT(u) FROM App\Entity\Users u')->getSingleScalarResult();
    }

    public function getProductsCount() {
//        return $this->manager->createQuery('SELECT COUNT(p) FROM App\Entity\Product p')->getSingleScalarResult();
        return $this->manager->createQuery(
            'SELECT COUNT(p.id) AS boughtProduct
            FROM App\Entity\Command c
            JOIN c.cartProduct cap
            JOIN cap.product p'
        )
            ->getSingleScalarResult();
    }

    public function getCommentsCount() {
        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\Comment c')->getSingleScalarResult();
    }

    public function getCommandsCount() {
        return $this->manager->createQuery('SELECT COUNT(c) FROM App\Entity\Command c')->getSingleScalarResult();
    }

    public function getProductsStats($order) {
        return $this->manager->createQuery(
            'SELECT AVG(c.rating) AS note, p.id, p.image, t.name, s.state
           FROM App\Entity\Comment c
           JOIN c.product p
           JOIN p.team t
           JOIN p.state s
           GROUP BY p
           ORDER BY note ' . $order
        )
            ->setMaxResults(5)
            ->getResult();
    }

    public function getRecentsCommands() {
        return $this->manager->createQuery(
            'SELECT COUNT(c.id) AS commands
            FROM App\Entity\Command c
            WHERE c.createdAt > :lastdays'
        )
            ->setParameter('lastdays', new \DateTime('- 7 days'))
            ->getSingleScalarResult();
    }

    public function getTotaux() {
        return $this->manager->createQuery(
            'SELECT SUM(c.total)
             FROM App\Entity\Command c
             '
        )
            ->getSingleScalarResult();
    }

    public function getRecentsTotaux() {
        return $this->manager->createQuery(
            'SELECT SUM(c.total)
             FROM App\Entity\Command c
             WHERE c.createdAt > :lastdays'
        )
            ->setParameter('lastdays', new \DateTime('- 7 days'))
            ->getSingleScalarResult();
    }

    public function getAvgComments() {
        return $this->manager->createQuery(
            'SELECT AVG(c.rating)
            FROM App\Entity\Comment c'
        )
            ->getSingleScalarResult();
    }
}