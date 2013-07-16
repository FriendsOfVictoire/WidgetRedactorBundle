<?php

namespace Victoire\RedactorBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


/**
 * WidgetRedactor form type
 */
class WidgetRedactorType extends AbstractType
{

    /**
     * define form fields
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('content')
            ->add('page', null,
                array(
                    "label" => "",
                    "attr" =>array("class" => "hide"))
                )
            ->add('slot', 'hidden')
        ;
    }


    /**
     * bind form to WidgetRedactor entity
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Victoire\RedactorBundle\Entity\WidgetRedactor'
        ));
    }


    /**
     * get form name
     */
    public function getName()
    {
        return 'appventus_venatorcmsbundle_widgetredactortype';
    }
}
