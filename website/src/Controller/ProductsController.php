<?php

namespace App\Controller;

use App\Entity\Products;

use App\Repository\LeaguesRepository;
use App\Repository\ProductsRepository;
use App\Repository\SizesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ProductsController extends AbstractController
{

    /**
     * @var ProductsRepository
     * @var SizesRepository
     */
    private $productsRepository;
    private $sizesRepository;

    /**
     * LeaguesController constructor.
     *
     * @param ProductsRepository $productsRepository
     * @param SizesRepository $sizesRepository
     */
    public function __construct(ProductsRepository $productsRepository, SizesRepository $sizesRepository)
    {
        $this->productsRepository = $productsRepository;
        $this->sizesRepository = $sizesRepository;
    }
    public function index(ProductsRepository $products, $id)
    {
        $product = $products->findOneById($id);

        return $this->render('products/index.html.twig', [
            'product' => $product
        ]);
    }

    public function show() {

    }
}
