<?php

namespace App\Form;

use App\Entity\League;
use App\Entity\Product;
use App\Entity\State;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends ConfigType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('team', EntityType::class, [
                'label' => 'Équipe :',
                'placeholder' => 'Équipe correspondante...',
                'class' => Team::class,
                'choice_label' => 'name',
                'group_by' => 'league.name',
                'query_builder' => function(TeamRepository $repo) {
                    return $repo->createAlphabeticalQueryBuilder();
                }
            ])
            ->add('state', EntityType::class, [
                'class' => State::class,
                'choice_label' => 'state'
            ])
            ->add('image')
            ->add('price', MoneyType::class)
            ->add('quantity', NumberType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
