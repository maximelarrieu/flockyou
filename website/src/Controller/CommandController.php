<?php

namespace App\Controller;

use App\Entity\Command;
use App\Repository\CommandRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    /**
     * @var CommandRepository
     */
    private $commandRepository;

    public function __construct(CommandRepository $commandRepository) {
        $this->commandRepository = $commandRepository;
    }

    public function index()
    {
        $user = $this->getUser();
        return $this->render('command/index.html.twig', [
            'commands' => $this->commandRepository->getUserCommands($user),
            'user' => $user,
        ]);
    }

    public function showCommand(Command $command) {
        $user = $this->getUser();
        return $this->render('command/showCommand.html.twig', [
            'command' => $command,
            'user' => $user
        ]);
    }
}
