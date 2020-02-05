<?php

namespace App\Controller;
use App\Entity\League;

use App\Entity\Product;
use App\Repository\LeagueRepository;
use App\Repository\ProductRepository;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LeaguesController extends AbstractController
{
    /**
     * @var ProductRepository
     * @var SizeRepository
     */
    private $productsRepository;
    private $sizesRepository;
    private $leaguesRepository;

    /**
     * LeaguesController constructor.
     *
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
     * @param LeagueRepository $leaguesRepository
     */
    public function __construct(ProductRepository $productsRepository, SizeRepository $sizesRepository, LeagueRepository $leaguesRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
        $this->leaguesRepository = $leaguesRepository;
    }

    public function index($league_name)
    {
        return $this->render('leagues/index.html.twig', [
            'league_name' => $league_name,
            'products' => $this->productsRepository->getProductFromLeague($league_name),
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }
}
