<?php

namespace App\Form;

use App\Entity\Flocage;
use App\Entity\Team;
use App\Repository\FlocageRepository;
use App\Repository\TeamRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlocageType extends ConfigType
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
            ->add('flocage', TextType::class, $this->getConfiguration("Flocage :", "Renseignez un flocage..."))
//            ->add('team', EntityType::class, [
//                'label' => 'Équipe :',
//                'placeholder' => 'Équipe associée...',
//                'class' => Team::class,
//                'choice_label' => 'name',
////                'query_builder' => function(TeamRepository $repo) use ($team) {
////                    return $repo->getTeam($team);
////                }
//            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Flocage::class,
            'team' => null
        ]);
//        $resolver->setRequired(['team']);
    }
}
