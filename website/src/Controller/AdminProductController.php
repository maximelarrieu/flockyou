<?php

namespace App\Controller;

use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\ProductRepository;
use App\Service\Pagination;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminProductController extends AbstractController
{
    public function index(ProductRepository $repo, $page, Pagination $pagination)
    {
        $pagination->setEntityClass(Product::class)
                    ->setPage($page);
        return $this->render('admin/products/index.html.twig', [
            'pagination' => $pagination
        ]);
    }

    public function create(Request $request, ObjectManager $manager) {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('admin_products');
        }

        $this->addFlash(
            'success',
            'Le produit a bien été créé'
        );

        return $this->render('admin/products/create.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

    public function edit(Product $products) {
        $form = $this->createForm(ProductType::class, $products);
            return $this->render('admin/products/edit.html.twig', [
                'product' => $products,
                'form' => $form->createView()
            ]);
    }

    public function destroy(Product $products, ObjectManager $manager) {

        $manager->remove($products);
        $manager->flush();

        $this->addFlash(
            'success',
            "Le produit a bien été supprimé !"
        );
        $this->addFlash(
            'danger',
            "Une erreur s'est produite !"
        );

        return $this->redirectToRoute('admin_products');
    }
}
