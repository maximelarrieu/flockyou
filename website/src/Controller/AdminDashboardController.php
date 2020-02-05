<?php

namespace App\Controller;

use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    public function index(ObjectManager $manager)
    {
        $users = $manager->createQuery('SELECT COUNT(u) FROM App\Entity\Users u')->getSingleScalarResult();
        $products = $manager->createQuery('SELECT COUNT(p) FROM App\Entity\Product p')->getSingleScalarResult();

        return $this->render('admin/dashboard/index.html.twig', [
            'stats' => compact('users', 'products')
        ]);
    }
}
