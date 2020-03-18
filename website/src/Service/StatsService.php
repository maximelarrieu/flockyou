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

        return compact('users', 'products', 'comments', 'commands', 'recentsCommands', 'totaux', 'recentsTotaux');
    }

    public function getUsersCount() {
        return $this->manager->createQuery('SELECT COUNT(u) FROM App\Entity\Users u')->getSingleScalarResult();
    }

    public function getProductsCount() {
//        return $this->manager->createQuery('SELECT COUNT(p) FROM App\Entity\Product p')->getSingleScalarResult();
        return $this->manager->createQuery(
            'SELECT COUNT(p.id) AS boughtProduct
            FROM App\Entity\Command c
            JOIN c.cart ca
            JOIN ca.product p'
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
            'SELECT AVG(c.rating) AS note, p.id, p.image, t.name
           FROM App\Entity\Comment c
           JOIN c.product p
           JOIN p.team t
           GROUP BY p
           ORDER BY note ' . $order
        )
            ->setMaxResults(5)
            ->getResult();
    }

    public function getRecentsCommands() {
        return $this->manager->createQuery(
            'SELECT COUNT(c.id) AS command
            FROM App\Entity\Command c
            WHERE c.createdAt > :lastdays'
        )
            ->setParameter('lastdays', new \DateTime('- 7 days'))
            ->getSingleScalarResult();
    }

    public function getTotaux() {
        return $this->manager->createQuery(
            'SELECT SUM(ca.total)
             FROM App\Entity\Command c
             JOIN c.cart ca
             '
        )
            ->getSingleScalarResult();
    }

    public function getRecentsTotaux() {
        return $this->manager->createQuery(
            'SELECT SUM(ca.total)
             FROM App\Entity\Command c
             JOIN c.cart ca
             WHERE c.createdAt > :lastdays'
        )
            ->setParameter('lastdays', new \DateTime('- 7 days'))
            ->getSingleScalarResult();
    }
}