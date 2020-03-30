<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Cart;
use App\Entity\Command;
use App\Entity\CommandProduct;
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
     * @param Cart $cart
     * @param Bank|null $bank
     * @param Livraison|null $livraison
     * @param Request $request
     * @param ObjectManager $manager
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function index(Cart $cart, Bank $bank = null, Livraison $livraison = null, Request $request, ObjectManager $manager)
    {
        $user = $this->getUser();
        $total = 0;

        foreach ($user->getCart()->getCartproduct() as $product) {
            $total += $product->getProduct()->getPrice() * $product->getQuantity();
        }

        $commandProducts = new CommandProduct();
        $command = new Command();

        $form = $this->createForm(CommandType::class, $commandProducts);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if($user->getBudget() > $total) {
                foreach ($user->getCartProducts() as $product) {
//                $command->setUser($user);
                    $commandProducts->setCommand($command);
                    $commandProducts->addCartProduct($product);
                    $command->setNbCommand(rand(2000, 8000));
                    $command->setCreatedAt(new \DateTime());
                    $command->setUser($user);
                    $command->setTotal($total);
                    $product->getProduct()->setQuantity($product->getProduct()->getQuantity() - $product->getQuantity());
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
            else {
                $this->addFlash(
                    'warning',
                    'Désolé, votre solde est insuffisant..'
                );

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
