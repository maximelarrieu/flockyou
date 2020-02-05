<?php

namespace App\Controller;

use App\Entity\Product;

use App\Entity\Team;
use App\Repository\LeagueRepository;
use App\Repository\ProductRepository;
use App\Repository\SizeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function create() {
        $product = new Product();

        $form = $this->createFormBuilder()
                    ->add('product_img', TextType::class, [
                        'label' => 'Image du produit',
                        'attr' => [
                            'placeholder' => "Lien de l'image du produit..."
                        ]
                    ])
                    ->add('price', MoneyType::class, [
                        'label' => 'Prix du produit',
                        'attr' => [
                            'placeholder' => "Renseignez le prix du produit..."
                        ]
                    ])
                    ->getForm()
        ;
        return $this->render('products/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function index(ProductRepository $products, $id)
    {
        $product = $products->findOneById($id);

        return $this->render('products/index.html.twig', [
            'product' => $product
        ]);
    }

    public function show() {

    }
}
