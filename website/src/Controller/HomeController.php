<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use App\Repository\LeaguesRepository;

use App\Repository\SizesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    /**
     * @var LeaguesRepository
     */
    private $leaguesRepository;

    /**
     * @var SizesRepository
     */
    private $sizesRepository;

    /**
     * HomeController constructor.
     *
     * @param LeaguesRepository $leaguesRepository
     * @param ProductsRepository $productsRepository
     * @param SizesRepository $sizesRepository
     */
    public function __construct(LeaguesRepository $leaguesRepository, ProductsRepository $productsRepository, SizesRepository $sizesRepository)
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
