<?php

namespace App\Controller;

use App\Entity\Flocage;
use App\Entity\Team;
use App\Form\TeamType;
use App\Repository\LeagueRepository;
use App\Repository\TeamRepository;
use App\Service\Pagination;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTeamsController extends AbstractController
{
    /**
     * @var $teamRepository
     * @var $leagueRepository
     */

    /**
     * @param teamRepository $teamRepository
     * @param leagueRepository $leagueRepository
     */
    private $teamRepository;
    private $leagueRepository;

    public function __construct(TeamRepository $teamRepository, LeagueRepository $leagueRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->leagueRepository = $leagueRepository;
    }

    public function index(Pagination $pagination, $page)
    {
        $pagination->setEntityClass(Team::class)
                    ->setPage($page);
        return $this->render('admin/teams/index.html.twig', [
            'pagination' => $pagination,
            'league' => $this->leagueRepository->findAll()
        ]);
    }

    public function create(Request $request, ObjectManager $manager) {
        $team = new Team();

        $form = $this->createForm(TeamType::class, $team);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($team);
            $manager->flush();

            return $this->redirectToRoute('admin_teams');
        }

        return $this->render('admin/teams/create.html.twig', [
            'team' => $team,
            'form' => $form->createView()
        ]);
    }

    public function edit(Request $request, Team $team, ObjectManager $manager) {

        $form = $this->createForm(TeamType::class, $team);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($team);
            $manager->flush();

            return $this->redirectToRoute('admin_teams');
        }

        return $this->render('admin/teams/edit.html.twig', [
            'form' => $form->createView(),
            'team' => $team
        ]);
    }

    public function destroy(Team $team, Flocage $flocage, ObjectManager $manager) {
        $manager->remove($team);
        $manager->remove($flocage);
        $manager->flush();

        return $this->redirectToRoute('admin_teams');
    }
}
