<?php

namespace App\Controller;

use App\Entity\CartProduct;
use App\Entity\Command;
use App\Entity\Comment;
use App\Entity\Product;
use App\Entity\Team;

use App\Form\BuyProductType;
use App\Form\CommentType;
use App\Repository\FlocageRepository;
use App\Repository\ProductRepository;
use App\Repository\SizeRepository;
use App\Service\Favorites;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends AbstractController
{

    /**
     * @var ProductRepository
     * @var SizeRepository
     * @var FlocageRepository
     */
    private $productsRepository;
    private $sizesRepository;
    private $flocageRepository;

    /**
     * LeaguesController constructor.
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
     * @param FlocageRepository $flocageRepository
     */
    public function __construct(ProductRepository $productsRepository, SizeRepository $sizesRepository, FlocageRepository $flocageRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
        $this->flocageRepository = $flocageRepository;
    }

    public function index(Product $product, Request $request, ObjectManager $manager, Favorites $service, $id)
    {
        $team = $product->getTeam()->getName();

        $buyProduct = new CartProduct();
        $quantity = 1;

        $formP = $this->createForm(BuyProductType::class, $buyProduct);
        $formP->handleRequest($request);

        if ($formP->isSubmitted() && $formP->isValid()) {

            $buyProduct->setProduct($product);
            $buyProduct->setCart($this->getUser()->getCart());
            $buyProduct->setQuantity($quantity);
            $buyProduct->setUser($this->getUser());

            $manager->persist($buyProduct);
            $manager->flush();

            return $this->redirectToRoute('cart', [
                'id' => $this->getUser()->getCart()->getId()
            ]);
        }

        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setProduct($product)
                ->setAuthor($this->getUser());
            $manager->persist($comment);
            $manager->flush();

            return $this->redirectToRoute('product', [
                'name' => $team,
                'id' => $id
            ]);
        }

        return $this->render('products/index.html.twig', [
            'team' => $team,
            'product' => $product,
            'sizes' => $this->sizesRepository->findAll(),
            'form' => $form->createView(),
            'formP' => $formP->createView(),
            'service' => $service
        ]);
    }

    public function show($league_name)
    {
        return $this->render('products/cardProduct.html.twig', [
            'league_name' => $league_name,
            'products' => $this->productsRepository->getProductFromLeague($league_name),
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }

    public function deleteProductInCart($cid, CartProduct $product, ObjectManager $manager)
    {
        $manager->remove($product);
        $manager->flush();

        return $this->redirectToRoute('cart', [
            'id' => $cid
        ]);
    }

    public function deleteComment(Comment $cid, Product $product, ObjectManager $manager)
    {
        $team = $product->getTeam()->getName();

        $manager->remove($cid);
        $manager->flush();

        return $this->redirectToRoute('product', [
            'id' => $product->getId(),
            'name' => $team
        ]);
    }
}
