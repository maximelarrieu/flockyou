<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Comment;
use App\Entity\Product;

use App\Entity\Team;
use App\Form\BuyProductType;
use App\Form\CommentType;
use App\Form\ProductType;
use App\Repository\FlocageRepository;
use App\Repository\LeagueRepository;
use App\Repository\ProductRepository;
use App\Repository\SizeRepository;
use App\Service\Favorites;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
     *
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
     * //     * @param FlocageRepository $flocageRepository
     */
    public function __construct(ProductRepository $productsRepository, SizeRepository $sizesRepository, FlocageRepository $flocageRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
        $this->flocageRepository = $flocageRepository;
    }

    public function index(Favorites $service, Product $product, Request $request, ObjectManager $manager, $team, $id)
    {
        $buyProduct = new Product();
        $formP = $this->createForm(BuyProductType::class, $buyProduct);
        $formP->handleRequest($request);

        if ($formP->isSubmitted() && $formP->isValid()) {
            $buyProduct->setImage($product->getImage());
            $buyProduct->setTeam($product->getTeam());
            $buyProduct->setPrice($product->getPrice());
            $buyProduct->setState($product->getState());
            $buyProduct->setQuantity($product->getQuantity());

            $manager->persist($buyProduct);
            dd($buyProduct);
            $manager->flush();

            $cart = new Cart();
            if($cart->getUser() === null) {
                dump($cart->getUser());
                $cart->setUser($this->getUser());
                $cart->addProduct($buyProduct);
                dump($cart);
            }
            else {
                $cart->addProduct($buyProduct);
            }
            dump($cart->getUser());
            dump($this->getUser());
//            else ($cart->getUser() === $this->getUser()) {
////                $manager->merge($cart->getUser());
//                $cart->addProduct($buyProduct);
//            }
////            if($cart->getUser() !== $this->getUser()) {
////                dump($cart->getUser());
////                $cart->setUser($this->getUser());
////                dump($cart->getUser());
////                $cart->addProduct($buyProduct);
////                dump($cart->getProduct());
////                $manager->persist($cart);
////                dump($cart->getUser()->getId());
////                $manager->flush();
////            }
////            elseif($cart->getUser()->getId() === $this->getUser()) {
////                dd($cart->getUser());
//////                $cart->setUser($this->getUser());
////                $cart->addProduct($buyProduct);
////                dd($cart->getUser($this->getUser()));
////                $manager->persist($cart);
////                $manager->flush();
////            }
//
            $manager->persist($cart);
//            $manager->merge($cart);
//            dd($cart);
            $manager->flush();
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
            'flocages' => $this->flocageRepository->getFlocageProduct($team),
            'form' => $form->createView(),
            'formP' => $formP->createView()
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

    public function deleteComment($id, $team, $cid, ObjectManager $manager, Comment $comment)
    {
        $manager->remove($comment);
        $manager->flush();

        return $this->redirectToRoute('product', [
            'team' => $team,
            'id' => $id
        ]);
    }
}
