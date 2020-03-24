<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Cart;
use App\Entity\Command;
use App\Entity\Livraison;
use App\Form\CommandType;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     * @param Bank|null $bank
     * @param Livraison|null $livraison
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Cart $cart, Bank $bank = null, Livraison $livraison = null, Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();
        $total = 0;

        foreach ($this->getUser()->getCart()->getCartProduct() as $product) {
            $total += $product->getProduct()->getPrice() * $product->getQuantity();
        }

        $command = new Command();

        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
//            $command->setCart($user->getCart());
            foreach ($user->getCartProduct() as $product) {
                $command->setUser($user);
                $command->addCartProduct($product);
                $command->setNbCommand(rand(2000, 8000));
                $command->setCreatedAt(new \DateTime());
            }
            $user->setBudget($user->getBudget() - $total);

            $newCart = new Cart();
            $user->setCart($newCart);

            $manager->persist($command);
            $manager->flush();

            return $this->redirectToRoute('account', [
               'username' => $this->getUser()->getUsername()
            ]);
        }

        return $this->render('cart/index.html.twig', [
            'bank' => $bank,
            'livraison' => $livraison,
            'cart' => $cart,
            'user' => $user,
            'total' => $total,
            'form' => $form->createView()
        ]);
    }
}
