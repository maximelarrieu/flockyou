<?php

namespace App\Controller;

use App\Entity\Products;

use App\Entity\Teams;
use App\Repository\LeaguesRepository;
use App\Repository\ProductsRepository;
use App\Repository\SizesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

    public function create() {
        $product = new Products();

        $form = $this->createFormBuilder($product)
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
