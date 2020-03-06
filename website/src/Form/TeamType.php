<?php

namespace App\Form;

use App\Entity\League;
use App\Entity\Team;
use App\Repository\LeagueRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeamType extends ConfigType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration("Nom de l'équipe :", "Renseignez un nom d'équipe..."))
            ->add('image', TextType::class, $this->getConfiguration("Image de l'équipe", "Sélectionnez un fichier..."))
            ->add('slug', TextType::class, $this->getConfiguration("Slug de l'équipe", "Définissez un slug d'équipe..."))
            ->add('league', EntityType::class, [
                'label' => 'Ligue :',
                'placeholder' => 'Ligue associée...',
                'class' => League::class,
                'choice_label' => 'name',
                'query_builder' => function(LeagueRepository $repo) {
                    return $repo->createAlphabeticalQueryBuilder();
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }
}
