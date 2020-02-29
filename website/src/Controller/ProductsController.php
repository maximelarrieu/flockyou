<?php

namespace App\Controller;

use App\Entity\Product;

use App\Entity\Team;
use App\Form\ProductType;
use App\Repository\LeagueRepository;
use App\Repository\ProductRepository;
use App\Repository\SizeRepository;
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
     */
    private $productsRepository;
    private $sizesRepository;

    /**
     * LeaguesController constructor.
     *
     * @param ProductRepository $productsRepository
     * @param SizeRepository $sizesRepository
     */
    public function __construct(ProductRepository $productsRepository, SizeRepository $sizesRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
    }

    public function index(ProductRepository $products, $id)
    {
        $product = $products->findOneById($id);

        return $this->render('products/index.html.twig', [
            'product' => $product,
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }

    public function show($league_name) {
        return $this->render('products/cardProduct.html.twig', [
            'league_name' => $league_name,
            'products' => $this->productsRepository->getProductFromLeague($league_name),
            'sizes' => $this->sizesRepository->findAll()
        ]);
    }
}
