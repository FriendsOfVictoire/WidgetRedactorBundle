<?php
namespace Victoire\RedactorBundle\Widget\Manager;

use Victoire\RedactorBundle\Form\WidgetRedactorType;
use Victoire\RedactorBundle\Entity\WidgetRedactor;

/**
 * CRUD operations on WidgetRedactor Widget
 */
class WidgetRedactorManager
{
protected $container;

    /**
     * constructor
     *
     * @param ServiceContainer $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * create a new WidgetRedactor
     * @param Page   $page
     * @param string $slot
     *
     * @return $widget
     */
    public function newWidget($page, $slot)
    {
        $widget = new WidgetRedactor();
        $widget->setPage($page);
        $widget->setslot($slot);

        return $widget;
    }
    /**
     * render the WidgetRedactor
     * @param Widget $widget
     *
     * @return widget show
     */
    public function render($widget)
    {
        return $this->container->get('templating')->render(
            "VictoireRedactorBundle:Widget:redactor/show.html.twig",
            array(
                "widget" => $widget
            )
        );
    }

    /**
     * render WidgetRedactor form
     * @param Form           $form
     * @param WidgetRedactor $widget
     * @return form
     */
    public function renderForm($form, $widget)
    {

        return $this->container->get('templating')->render(
            "VictoireRedactorBundle:Widget:redactor/edit.html.twig",
            array("widget" => $widget, 'form' => $form->createView(), 'id' => $widget->getId())
        );
    }

    /**
     * create a form with given widget
     * @param WidgetRedactor $widget
     * @return $form
     */
    public function buildForm($widget)
    {
        $form = $this->container->get('form.factory')->create(new WidgetRedactorType(), $widget);

        return $form;
    }

    /**
     * create form new for WidgetRedactor
     * @param Form           $form
     * @param WidgetRedactor $widget
     * @param string         $slot
     * @param Page           $page
     *
     * @return new form
     */
    public function renderNewForm($form, $widget, $slot, $page)
    {

        return $this->container->get('templating')->render(
            "VictoireRedactorBundle:Widget:redactor/new.html.twig",
            array(
                "widget" => $widget,
                'form' => $form->createView(),
                "slot" => $slot,
                "renderContainer" => true,
                "page" => $page
            )
        );
    }

}
