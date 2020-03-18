<?php

namespace App\Controller;

use App\Entity\Flocage;
use App\Entity\Team;
use App\Form\FlocageType;
use App\Repository\FlocageRepository;
use App\Repository\ProductRepository;
use App\Repository\TeamRepository;
use App\Service\Pagination;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminFlocageController extends AbstractController
{
    /**
     * AdminFlocageController constructor.
     * @var TeamRepository
     * @var FlocageRepository
     * @var ProductRepository
     */
    private $teamRepository;
    private $flocageRepository;
    private $productRepository;

    /**
     * AdminFlocageController constructor.
     * @param TeamRepository $teamRepository
     * @param FlocageRepository $flocageRepository
     * @param ProductRepository $productRepository
     */

    public function __construct(TeamRepository $teamRepository, FlocageRepository $flocageRepository, ProductRepository $productRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->flocageRepository = $flocageRepository;
        $this->productRepository = $productRepository;
    }

    public function index($team) {
        return $this->render('admin/flocages/index.html.twig', [
            'team' => $team,
            'flocages' => $this->flocageRepository->getFlocageFromTeam($team),
            'products' => $this->productRepository->getProductFromTeam($team)
        ]);
    }

    public function create(Team $team, Request $request, ObjectManager $manager) {
        $flocage = new Flocage();

        $form = $this->createForm(FlocageType::class, $flocage);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $flocage->setTeam($team);

            $manager->persist($flocage);
            $manager->flush();

            return $this->redirectToRoute('admin_flocages', [
                'team' => $team->getName()
            ]);
        }

        return $this->render('admin/flocages/create.html.twig', [
            'team' => $team,
            'flocage' => $flocage,
            'form' => $form->createView(),
//            'teams' => $this->teamRepository->getTeamFromRoute($team)
        ]);
    }

    public function edit(Request $request, Flocage $flocage, $team, ObjectManager $manager) {

        $form = $this->createForm(FlocageType::class, $flocage);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $flocage->setTeam($flocage->getTeam());

            $manager->persist($flocage);
            $manager->flush();

            return $this->redirectToRoute('admin_flocages', [
                'team' => $team
            ]);
        }

        return $this->render('admin/flocages/edit.html.twig', [
            'flocage' => $flocage,
            'form' => $form->createView(),
        ]);
    }

    public function destroy(Flocage $flocage, $team, ObjectManager $manager) {
        $manager->remove($flocage);
        $manager->flush();

        return $this->redirectToRoute('admin_flocages', [
            'team' => $team
        ]);
    }

    public function back() {
        return $this->redirectToRoute('admin_teams');
    }
}
