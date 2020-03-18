<?php

namespace App\Controller;
use App\Entity\League;

use App\Entity\Product;
use App\Repository\LeagueRepository;
use App\Repository\ProductRepository;
use App\Repository\SizeRepository;
use App\Repository\StateRepository;
use App\Repository\TeamRepository;
use App\Service\LeaguePagination;
use App\Service\Pagination;
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
    private $stateRepository;
    private $teamRepository;

    /**
     * LeaguesController constructor.
     *
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
     * @param LeagueRepository $leaguesRepository
     * @param StateRepository $stateRepository
     * @param TeamRepository $teamRepository
     */
    public function __construct(ProductRepository $productsRepository, SizeRepository $sizesRepository, LeagueRepository $leaguesRepository, StateRepository $stateRepository, TeamRepository $teamRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
        $this->leaguesRepository = $leaguesRepository;
        $this->stateRepository = $stateRepository;
        $this->teamRepository = $teamRepository;
    }

    public function index($league_name, LeaguePagination $lpagination, $page)
    {
        $lpagination->setEntityClass(Product::class)
                    ->setPage($page);

        return $this->render('leagues/index.html.twig', [
            'league_name' => $league_name,
            'states' => $this->stateRepository->findAll(),
            'products' => $this->productsRepository->getProductFromLeague($league_name),
            'sizes' => $this->sizesRepository->findAll(),
            'teams' => $this->teamRepository->getTeamFromLeague($league_name),
            'pagination' => $lpagination
        ]);
    }
}
