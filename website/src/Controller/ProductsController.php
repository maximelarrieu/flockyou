<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{
    /**
     * @Route("/products", name="products")
     */
    public function index()
    {
        return $this->render('products/cardProduct.html.twig', [
            'controller_name' => 'ProductsController',
        ]);
    }

    public function show() {

    }

    public function championsleague() {
        return $this->render('leagues/cl.html.twig');
    }

    public function euro() {
        return $this->render('leagues/euro.html.twig');
    }
}
