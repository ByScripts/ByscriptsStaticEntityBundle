<?php


namespace Byscripts\Bundle\StaticEntityBundle\Form\Type;

use Byscripts\StaticEntity\StaticEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class StaticEntityType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            [
                'function' => 'getAll',
                'property' => 'name',
                'group_by' => null,
                'choice_list' => function (Options $options) {
                    return new ObjectChoiceList(
                        $options['class']::$options['function'](),
                        $options['property'],
                        $options['preferred_choices'],
                        $options['group_by'],
                        'id'
                    );
                }
            ]
        );
        $resolver->setRequired(['class']);
        $resolver->setOptional(['function', 'property', 'group_by']);
    }

    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'static_entity';
    }
}
