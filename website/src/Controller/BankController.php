<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Livraison;
use App\Form\BankType;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BankController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, ObjectManager $manager)
    {
        $bank = new Bank();

        $form = $this->createForm(BankType::class, $bank);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();

            $bank->setUser($user);
            $manager->persist($bank);
            $manager->flush();

            return $this->redirectToRoute('account', [
               'username' => $user->getUsername()
            ]);
        }
        return $this->render('bank/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Bank $bank, ObjectManager $manager) {
        $form = $this->createForm(BankType::class, $bank);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($bank);
            $manager->flush();

            return $this->redirectToRoute('account', [
                'username' => $bank->getUser()->getUsername()
            ]);
        }

        return $this->render('bank/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @IsGranted("ROLE_USER")
     */
    public function delete(Bank $bank, ObjectManager $manager) {
        $username = $this->getUser()->getUsername();

        $manager->remove($bank);
        $manager->flush();

        $this->addFlash(
            'success',
            "Les données bancaires ont bien été supprimées !"
        );
        $this->addFlash(
            'danger',
            "Une erreur s'est produite !"
        );

        return $this->redirectToRoute('account', [
           'username' => $username
        ]);

    }
}
