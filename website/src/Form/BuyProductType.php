<?php

namespace App\Form;

use App\Entity\Cart;
use App\Entity\Flocage;
use App\Entity\Product;
use App\Entity\Size;
use App\Repository\FlocageRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyProductType extends AbstractType
{
    private $repo;
    private $request;

    public function __construct(FlocageRepository $repo, RequestStack $request)
    {
        $this->repo = $repo;
        $this->request = $request;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
          $builder
            ->add('size', EntityType::class, [
                'label' => 'Taille :',
                'placeholder' => 'Sélectionnez votre taille',
                'class' => Size::class,
                'choice_label' => 'name'
            ])

            ->add('flocage', EntityType::class, [
                'label' => 'Flocage :',
                'placeholder' => 'Sélectionnez votre flocage',
                'class' => Flocage::class,
                'choice_label' => 'flocage',
                'choices' => $this->repo->getFlocageProduct($this->request->getMasterRequest()->attributes->get('name'))
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class
        ]);
    }
}
