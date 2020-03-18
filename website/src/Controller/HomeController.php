<?php

namespace App\Controller;

use App\Entity\Product;
//use App\Repository\CartRepository;
use App\Repository\CartRepository;
use App\Repository\ProductRepository;
use App\Repository\LeagueRepository;

use App\Repository\SizeRepository;
use App\Service\Favorites;
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
//    /**
//     * @var CartRepository
//     */
//    private $cartRepository;

    /**
     * HomeController constructor.
     *
     * @param LeagueRepository $leaguesRepository
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
//     * @param CartRepository $cartRepository
     */
    public function __construct(LeagueRepository $leaguesRepository, ProductRepository $productsRepository, SizeRepository $sizesRepository)
    {
        $this->productsRepository =  $productsRepository;
        $this->leaguesRepository = $leaguesRepository;
        $this->sizesRepository = $sizesRepository;
//        $this->cartRepository = $cartRepository;
    }

    public function index(ProductRepository $repo)
    {
        return $this->render('home/index.html.twig', [
            'products' => $this->productsRepository->findAll(),
            'bestProducts' => $this->productsRepository->findBestProducts(8),
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }

    public function navbar(Favorites $service) {
        return $this->render('header.html.twig', [
//            'cart' => $this->cartRepository->findAll(),
            'leagues' => $this->leaguesRepository->findAll(),
            'nbProducts' => $service->nbProducts(),
        ]);
    }

    public function caroussel() {
        return $this->render('caroussel.html.twig');
    }

    public function footer() {
        return $this->render('footer.html.twig');
    }
}
