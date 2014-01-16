<?php

namespace Victoire\RedactorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Victoire\CmsBundle\Form\EntityProxyFormType;
use Victoire\CmsBundle\Form\WidgetType;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;


/**
 * WidgetRedactor form type
 */
class WidgetRedactorType extends WidgetType
{

    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     * @return void
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //choose form mode
        if ($this->entity_name === null) {
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
     * @param OptionsResolverInterface $resolver
     *
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'         => 'Victoire\RedactorBundle\Entity\WidgetRedactor',
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
        return 'appventus_victoirecmsbundle_widgetredactortype';
    }
}
