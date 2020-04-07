<?php

namespace App\Controller;

use App\Entity\Command;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    public function index()
    {
        $user = $this->getUser();

        return $this->render('command/index.html.twig', [
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
