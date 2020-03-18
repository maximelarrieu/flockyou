<?php

namespace App\Controller;

use App\Service\StatsService;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    public function index(ObjectManager $manager, StatsService $service)
    {
        $stats = $service->getStats();
        $bestProducts = $service->getProductsStats('DESC');
        $worstProducs = $service->getProductsStats('ASC');

        return $this->render('admin/dashboard/index.html.twig', [
            'stats' => $stats,
            'bestProducts' => $bestProducts,
            'worstProducts' => $worstProducs
        ]);
    }
}
