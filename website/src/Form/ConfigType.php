<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;

class ConfigType extends AbstractType
{
    /**
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    protected function getConfiguration($label, $placeholder, $options = []) {
        return array_merge_recursive([
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ], $options);
    }
}