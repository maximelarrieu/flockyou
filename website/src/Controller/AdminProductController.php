<?php

namespace App\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminProductController extends AbstractController
{
    public function index(ProductsRepository $repo)
    {
        return $this->render('admin/products/index.html.twig', [
            'products' => $repo->findAll()
        ]);
    }

    public function edit(Products $products) {
    }
}
