<?php

namespace Victoire\Widget\RedactorBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Victoire\Bundle\CoreBundle\Form\WidgetType;

/**
 * WidgetRedactor form type
 */
class WidgetRedactorType extends WidgetType
{
    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array                $options
     *
     * @return void
     *
     * @throws \Exception
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        //choose form mode
        if ($options['businessEntityId'] === null) {
            //if no entity is given, we generate the static form
            $builder
                ->add('content', null, array(
                        'attr' => array('class' => 'redactor')
                    ));
        }

        parent::buildForm($builder, $options);

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\RedactorBundle\Entity\WidgetRedactor',
            'widget'             => 'Redactor',
            'translation_domain' => 'victoire'
        ));
    }
}
