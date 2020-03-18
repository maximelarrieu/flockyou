<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Team;
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

    public function create(Team $team, Request $request, ObjectManager $manager) {
        $product = new Product();

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $product->setTeam($team);
            $manager->persist($product);
            $manager->flush();

            return $this->redirectToRoute('admin_flocages', [
                'team' => $product->getTeam()->getName()
            ]);
        }

        return $this->render('admin/products/create.html.twig', [
            'product' => $product,
            'form' => $form->createView()
        ]);
    }

    public function edit(Request $request, Product $products, ObjectManager $manager) {

        $form = $this->createForm(ProductType::class, $products);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $manager->persist($products);
            $manager->flush();

            return $this->redirectToRoute('admin_flocages', [
                'team' => $products->getTeam()->getName()
            ]);
        }

        return $this->render('admin/products/edit.html.twig', [
            'form' => $form->createView(),
            'product' => $products
        ]);
    }

    public function destroy(Product $products, ObjectManager $manager) {

        $manager->remove($products);
        $manager->flush();

        return $this->redirectToRoute('admin_flocages', [
            'team' => $products->getTeam()->getName()
        ]);
    }
}
