<?php
namespace Victoire\RedactorBundle\Widget\Manager;

use Victoire\RedactorBundle\Form\WidgetRedactorType;
use Victoire\RedactorBundle\Entity\WidgetRedactor;
use Victoire\Bundle\CoreBundle\Widget\Managers\ManagerInterface;

/**
 * CRUD operations on WidgetRedactor Widget
 */
class WidgetRedactorManager implements ManagerInterface
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
        $widget->setSlot($slot);

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
        return $this->container->get('victoire_templating')->render(
            "VictoireRedactorBundle::show.html.twig",
            array(
                "widget" => $widget
            )
        );
    }

    /**
     * render WidgetRedactor form
     * @param Form           $form
     * @param WidgetRedactor $widget
     * @param BusinessEntity $entity
     * @return form
     */
    public function renderForm($form, $widget, $entity = null)
    {
        return $this->container->get('victoire_templating')->render(
            "VictoireRedactorBundle::edit.html.twig",
            array(
                "widget" => $widget,
                'form'   => $form->createView(),
                'id'     => $widget->getId(),
                'entity' => $entity
            )
        );
    }

    /**
     * create a form with given widget
     * @param WidgetRedactor $widget
     * @param string         $entityName
     * @param string         $namespace
     * @return $form
     */
    public function buildForm($widget, $entityName = null, $namespace = null)
    {
        $form = $this->container->get('form.factory')->create(new WidgetRedactorType($entityName, $namespace), $widget);

        return $form;
    }

    /**
     * create form new for WidgetRedactor
     * @param Form           $form
     * @param WidgetRedactor $widget
     * @param string         $slot
     * @param Page           $page
     * @param string         $entity
     *
     * @return new form
     */
    public function renderNewForm($form, $widget, $slot, $page, $entity = null)
    {

        return $this->container->get('victoire_templating')->render(
            "VictoireRedactorBundle::new.html.twig",
            array(
                "widget"          => $widget,
                'form'            => $form->createView(),
                "slot"            => $slot,
                "entity"          => $entity,
                "renderContainer" => true,
                "page"            => $page
            )
        );
    }

    public function getWidgetName()
    {
        return 'redactor';
    }

}
