<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\AccountType;
use App\Service\Pagination;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminUsersController extends AbstractController
{
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

        $this->addFlash(
            'success',
            "L'utilisateur a bien été modifié"
        );

        return $this->render('admin/users/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function destroy(Users $users, ObjectManager $manager) {

        $manager->remove($users);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'utilisateur a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_users');
    }
}