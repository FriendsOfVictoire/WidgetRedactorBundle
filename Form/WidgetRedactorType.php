<?php

namespace Victoire\Widget\RedactorBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
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
        if ($options['entityName'] === null) {
            //if no entity is given, we generate the static form
            $builder
                ->add('content', null, array(
                        'attr' => array('class' => 'redactor')
                    ));
        }

        parent::buildForm($builder, $options);

    }

    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        parent::setDefaultOptions($resolver);

        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\Widget\RedactorBundle\Entity\WidgetRedactor',
            'widget'             => 'redactor',
            'translation_domain' => 'victoire'
        ));
    }

    /**
     * get form name
     * @return string type
     */
    public function getName()
    {
        return 'victoire_widget_form_redactor';
    }
}
