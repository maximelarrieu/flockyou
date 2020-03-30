<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Command;
use App\Entity\Livraison;
use App\Entity\Users;
use App\Form\LivraisonType;
use App\Repository\LivraisonRepository;
use App\Service\StatsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    /**
     * @param Users $user
     * @param Livraison $livraison ;
     * @param Bank|null $bank
     * @param Command $command
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Users $user, Livraison $livraison = null, Bank $bank = null)
    {
        $command = $user->getCommands();

        return $this->render('account/index.html.twig', [
            'command' => $command,
            'user' => $user,
            'livraison' => $livraison,
            'bank' => $bank
        ]);
    }
}
