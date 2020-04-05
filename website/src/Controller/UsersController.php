<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Command;
use App\Entity\Livraison;
use App\Entity\Users;
use App\Form\LivraisonType;
use App\Repository\CommandRepository;
use App\Repository\LivraisonRepository;
use App\Service\StatsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @var CommandRepository
     */
    private $commandRepository;

    public function __construct(CommandRepository $commandRepository)
    {
        $this->commandRepository = $commandRepository;
    }
    /**
     * @param Users $user
     * @param Livraison $livraison ;
     * @param Bank|null $bank
     * @param Command $command
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Users $user, Livraison $livraison = null, Bank $bank = null, Command $command = null)
    {
        return $this->render('account/index.html.twig', [
            'lastCommand' => $this->commandRepository->findLastUserCommand($user, 1),
            'command' => $command,
            'user' => $user,
            'livraison' => $livraison,
            'bank' => $bank
        ]);
    }
}
