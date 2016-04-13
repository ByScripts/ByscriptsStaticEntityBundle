<?php

namespace Byscripts\Bundle\StaticEntityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StaticEntityType extends AbstractType
{
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'function' => 'getAll',
                'choice_label' => 'name',
            ]
        );
        $resolver->setRequired('class');
        $resolver->setDefined(['function']);

        $resolver->setNormalizer(
            'choices',
            function (Options $options) {
                return call_user_func([$options['class'], $options['function']]);
            }
        );
    }

    /**
     * @return string
     */
    public function getParent()
    {
        return ChoiceType::class;
    }
}
