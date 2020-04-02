<?php

namespace App\Form;

use App\Entity\CartProduct;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NbProductType extends ConfigType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class, $this->getConfiguration('Quantité :', 'Indiquez la quantité voulue', [
                'attr' => [
                    'min' => 1,
                    'max' => 10,
                    'step' => 1
                ]
            ]))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CartProduct::class
        ]);
    }
}
