<?php

namespace App\Form;

use App\Entity\Bank;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BankType extends ConfigType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cart_number', NumberType::class, $this->getConfiguration('Numéro de carte :', 'Votre numéro de carte...'))
            ->add('expiration_date', DateType::class, [
                'format' => 'dd MM yyyy',
                ])
            ->add('cart_code', NumberType::class, $this->getConfiguration("Code secret :", "Votre code secret"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bank::class,
        ]);
    }
}
