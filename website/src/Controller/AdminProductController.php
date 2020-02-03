<?php

namespace App\Controller;

use App\Entity\Products;
use App\Form\ProductType;
use App\Repository\ProductsRepository;
use App\Service\Pagination;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminProductController extends AbstractController
{
    public function index(ProductsRepository $repo, $page, Pagination $pagination)
    {
        $pagination->setEntityClass(Products::class)
                    ->setPage($page);
        return $this->render('admin/products/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    public function edit(Products $products, ObjectManager $manager) {
        $form = $this->createForm(ProductType::class, $products);
            return $this->render('admin/products/edit.html.twig', [
                'product' => $products,
                'form' => $form->createView()
            ]);
    }

    public function destroy(Products $products, ObjectManager $manager) {

        $manager->remove($products);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le produit a bien été supprimé !"
        );

        return $this->redirectToRoute('admin_products');
    }
}
