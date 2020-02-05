<?php

namespace App\Controller;

use App\Entity\Users;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    public function index()
    {
        return $this->render('profile/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}
