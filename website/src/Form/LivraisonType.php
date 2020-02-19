<?php

namespace App\Form;

use App\Entity\Livraison;
use App\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use League\Flysystem\Config;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends ConfigType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getConfiguration('Nom complet :', 'Votre nom complet...'))
            ->add('phone_number', NumberType::class, $this->getConfiguration('Numéro de téléphone :', 'Votre numéro de téléphone...'))
            ->add('country', TextType::class, $this->getConfiguration('Pays :', 'Votre pays...'))
            ->add('city', TextType::class, $this->getConfiguration('Ville :', 'Votre ville...'))
            ->add('address', TextType::class, $this->getConfiguration('Adresse complète:', 'Adresse complète...'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}
