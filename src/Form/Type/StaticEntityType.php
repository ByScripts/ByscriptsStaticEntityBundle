<?php


namespace Byscripts\Bundle\StaticEntityBundle\Form\Type;

use Byscripts\StaticEntity\StaticEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\ObjectChoiceList;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

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
                'group_by' => null,
                'choice_list' => function (Options $options) {
                    return new ObjectChoiceList(
                        call_user_func(array($options['class'], $options['function'])),
                        $options['choice_label'],
                        $options['preferred_choices'],
                        $options['group_by'],
                        'id'
                    );
                }
            ]
        );
        $resolver->setRequired('class');
        $resolver->setDefined(['function', 'choice_label', 'group_by']);
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
