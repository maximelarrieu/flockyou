<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends ConfigType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, $this->getConfiguration("Nom d'utilisateur :", "Renseignez un nom d'utilisateur..."))
            ->add('email', EmailType::class, $this->getConfiguration("Adresse email :", "Renseignez une adresse email valide..."))
            ->add('password', PasswordType::class, $this->getConfiguration("Mot de passe :", "Renseignez un bon mot de passe..."))
            ->add('passwordConfirm', PasswordType::class, $this->getConfiguration("Confirmation du mot de passe :", "Veuillez confirmer votre mot de passe..."))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
