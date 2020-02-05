<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Repository\LeagueRepository;

use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    private $productsRepository;

    /**
     * @var LeagueRepository
     */
    private $leaguesRepository;

    /**
     * @var SizeRepository
     */
    private $sizesRepository;

    /**
     * HomeController constructor.
     *
     * @param LeagueRepository $leaguesRepository
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
     */
    public function __construct(LeagueRepository $leaguesRepository, ProductRepository $productsRepository, SizeRepository $sizesRepository)
    {
        $this->productsRepository =  $productsRepository;
        $this->leaguesRepository = $leaguesRepository;
        $this->sizesRepository = $sizesRepository;
    }

    public function index()
    {
        return $this->render('home/index.html.twig', [
            'products' => $this->productsRepository->findAll(),
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }

    public function navbar() {
        return $this->render('header.html.twig', [
            'leagues' => $this->leaguesRepository->findAll()
        ]);
    }

    public function caroussel() {
        return $this->render('caroussel.html.twig');
    }

    public function footer() {
        return $this->render('footer.html.twig');
    }
}
