<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Cart;
use App\Entity\Livraison;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart")
     * @param Bank|null $bank
     * @param Livraison|null $livraison
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Cart $cart, Bank $bank = null, Livraison $livraison = null)
    {
        $user = $this->getUser();

        $total = 0;

        foreach ($this->getUser()->getCart()->getCartProduct() as $product) {
            $total += $product->getProduct()->getPrice() * $product->getQuantity();
        }

        return $this->render('cart/index.html.twig', [
            'bank' => $bank,
            'livraison' => $livraison,
            'cart' => $cart,
            'user' => $user,
            'total' => $total
        ]);
    }
}
