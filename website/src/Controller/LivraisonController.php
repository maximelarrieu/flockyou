<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Entity\Users;
use App\Form\LivraisonType;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LivraisonController extends AbstractController
{
    /**
     * @IsGranted("ROLE_USER")
     */
    public function create(Request $request, ObjectManager $manager) {


        $livraison = new Livraison();

        $form = $this->createForm(LivraisonType::class, $livraison);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            /** @var Users $user */
            $user = $this->getUser(); // Retrieve the current user

            $livraison->setUser($user); // Set the current user :D
            $manager->persist($livraison);
            $manager->flush();

            return $this->redirectToRoute('account', [
                'username' => $user->getUsername()
            ]);
        }
        return $this->render('livraison/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_USER")
     */
    public function edit(Request $request, Livraison $livraison, ObjectManager $manager) {

        $form = $this->createForm(LivraisonType::class, $livraison);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            $manager->persist($livraison);
            $manager->flush();

            return $this->redirectToRoute('account', [
                'username' => $livraison->getUser()->getUsername()
            ]);
        }

        return $this->render('livraison/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function delete(Livraison $livraison, ObjectManager $manager) {
        $username = $this->getUser()->getUsername();

        $manager->remove($livraison);
        $manager->flush();

        $this->addFlash(
            'success',
            "L'adresse a bien été supprimée"
        );

        return $this->redirectToRoute('account', [
            'username' => $username
        ]);
    }
}
