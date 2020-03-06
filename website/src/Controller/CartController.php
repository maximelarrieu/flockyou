<?php

namespace App\Controller;

use App\Entity\Bank;
use App\Entity\Cart;
use App\Entity\Livraison;
use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\Favorites;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @param Cart $cart
     * @param Livraison|null $livraion
     * @param Bank|null $bank
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index(Livraison $livraion = null, Bank $bank = null)
    {
//        $cartP = $cart->getProduct();

        return $this->render('cart/index.html.twig', [
//            'cart' => $id,
//            'products' => $this->productRepository->getProductFromCart($id),
            'user' => $this->getUser(),
////            'cartP' => $cartP->getProduct(),
////            'total' => $service->getTotal(),
//            'livraison' => $livraion,
//            'bank' => $bank
        ]);
    }

    public function add($id, Favorites $service) {

        $service->add($id);

        return $this->redirectToRoute('cart');

    }

    public function destroy($id, Favorites $service) {

        $service->remove($id);

        return $this->redirectToRoute('cart');
    }
}
