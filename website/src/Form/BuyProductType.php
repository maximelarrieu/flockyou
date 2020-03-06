<?php

namespace App\Form;

use App\Entity\Flocage;
use App\Entity\Product;
use App\Entity\Size;
use App\Entity\Team;
use App\Repository\FlocageRepository;
use App\Repository\SizeRepository;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyProductType extends AbstractType
{
    private $team;

    public function __construct()
    {
        $team = $this->team;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $team = $this->team;

        $builder
//            ->add('image')
//            ->add('quantity')
//            ->add('price')
//            ->add('team')
//            ->add('state')
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
                'query_builder' => function(FlocageRepository $repo) use ($team) {
                    return $repo->getFlocageProduct($team);
                }
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
