<?php

namespace App\Controller;
use App\Entity\Leagues;

use App\Entity\Products;
use App\Repository\LeaguesRepository;
use App\Repository\ProductsRepository;
use App\Repository\SizesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LeaguesController extends AbstractController
{
    /**
     * @var ProductsRepository
     * @var SizesRepository
     */
    private $productsRepository;
    private $sizesRepository;
    private $leaguesRepository;

    /**
     * LeaguesController constructor.
     *
     * @param ProductsRepository $productsRepository
     * @param SizesRepository $sizesRepository
     * @param LeaguesRepository $leaguesRepository
     */
    public function __construct(ProductsRepository $productsRepository, SizesRepository $sizesRepository, LeaguesRepository $leaguesRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
        $this->leaguesRepository = $leaguesRepository;
    }

    public function index(Leagues $leagues, $league_name)
    {
        return $this->render('leagues/index.html.twig', [
            'league_name' => $league_name,
            'products' => $this->productsRepository->getProductFromLeague($league_name),
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }
}
