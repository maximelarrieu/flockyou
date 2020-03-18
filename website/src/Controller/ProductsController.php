<?php

namespace App\Controller;

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

    public function index(Product $product, Request $request, ObjectManager $manager, Favorites $service, Team $team, $id)
    {
        $buyProduct = $product;
//        $buyProduct = new Cart();
//        $cart = $this->getUser()->getCart();

        $formP = $this->createForm(BuyProductType::class, $buyProduct);
        $formP->handleRequest($request);

//        $product->setImage($product->getImage());

        if ($formP->isSubmitted() && $formP->isValid()) {

//            $cart->setFlocage($product->getFlocage());
//            $buyProduct->setImage($product->getImage());
//            $buyProduct->setTeam($product->getTeam());
//            $buyProduct->setPrice($product->getPrice());
//            $buyProduct->setState($product->getState());
//            $buyProduct->setQuantity(1);
//            $buyProduct->getFlocage();

//            $cart->addProduct($buyProduct);

            $manager->persist($buyProduct);
            $manager->flush();

            return $this->redirectToRoute('cart', [
                'id' => $cart->getId()
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
                'team' => $team,
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

    public function deleteProductInCart($cid, Product $product, ObjectManager $manager)
    {
        $manager->remove($product);
        $manager->flush();

        return $this->redirectToRoute('cart', [
            'id' => $cid
        ]);
    }

    public function deleteComment($id, $team, ObjectManager $manager, Comment $comment)
    {
        $manager->remove($comment);
        $manager->flush();

        return $this->redirectToRoute('product', [
            'team' => $team,
            'id' => $id
        ]);
    }
}
