<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\AccountType;
use App\Repository\CommandRepository;
use App\Service\Pagination;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
    /**
     * @var CommandRepository
     */
    private $commandRepository;

    public function __construct(CommandRepository $commandRepository) {
        $this->commandRepository = $commandRepository;
    }

    public function index($page, Pagination $pagination)
    {
        $pagination->setEntityClass(Users::class)
            ->setPage($page);

        return $this->render('admin/users/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    public function edit(Users $users, Request $request) {

        $form = $this->createForm(AccountType::class, $users);

        $form->handleRequest($request);

        return $this->render('admin/users/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $users
        ]);
    }

    public function destroy(Users $users, ObjectManager $manager) {

        $manager->remove($users);
        $manager->flush();

        return $this->redirectToRoute('admin_users');
    }

    public function commands(Users $users) {
        return $this->render('admin/users/commands.html.twig', [
            'commands' => $this->commandRepository->getUserCommands($users),
            'user' => $users->getUsername()
        ]);
    }
}