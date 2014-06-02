<?php
namespace Victoire\RedactorBundle\Widget\Manager;

use Victoire\RedactorBundle\Form\WidgetRedactorType;
use Victoire\RedactorBundle\Entity\WidgetRedactor;
use Victoire\Bundle\CoreBundle\Widget\Managers\ManagerInterface;
use Victoire\Bundle\PageBundle\Entity\BasePage;
use Victoire\Bundle\CoreBundle\Widget\Managers\BaseWidgetManager;
use Victoire\Bundle\CoreBundle\Entity\Widget;
use Victoire\Bundle\CoreBundle\Event\WidgetBuildFormEvent;
use Victoire\Bundle\CoreBundle\VictoireCmsEvents;

/**
 * CRUD operations on WidgetRedactor Widget
 */
class WidgetRedactorManager extends BaseWidgetManager
{
    /**
     * Get a new widget entity
     *
     * @return Widget
     */
    protected function getNewWidgetEntity()
    {
        $widget = new WidgetRedactor();

        return $widget;
    }

    /**
     * render the WidgetRedactor
     * @param WidgetRedactor $widget
     *
     * @return widget show
     */
    public function render(Widget $widget)
    {
        //the templating service
        $templating = $this->container->get('victoire_templating');

        //the mode of display of the widget
        $mode = $widget->getMode();

        //the widget must have a mode
        if ($mode === null) {
            throw new \Exception('The widget ['.$widget->getId().'] has no mode.');
        }

        //the content of the widget
        $content = '';

        switch ($mode) {
        	case Widget::MODE_STATIC:
        	    $content = $widget->getContent();
        	    break;
        	case Widget::MODE_ENTITY:
        	    //get the content of the widget with its entity
        	    $content = $this->getWidgetEntityContent($widget);
        	    break;
    	    case Widget::MODE_BUSINESS_ENTITY:
    	        //get the entity
    	        $entity = $widget->getEntity();

    	        //display a generic content if no entity were specified
    	        if ($entity === null) {
    	            $content = $this->getWidgetGenericBusinessEntityContent($widget);
    	        } else {
    	            //get the content of the widget with its entity
    	            $content = $this->getWidgetEntityContent($widget);
    	        }
        	    break;
        	case Widget::MODE_QUERY:
        	    throw new \Exception('The mode ['.$mode.'] is not yet supported by the widget redactor manager. Widget ID:['.$widget->getId().']');
        	    break;
        	default:
        	    throw new \Exception('The mode ['.$mode.'] is not supported by the widget redactor manager. Widget ID:['.$widget->getId().']');
        }

        return $templating->render(
            "VictoireRedactorBundle::show.html.twig",
            array(
                "widget" => $widget,
                "content" => $content
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
    public function buildWidgetForm($widget, $entityName = null, $namespace = null)
    {
        //test parameters
        if ($entityName !== null) {
            if ($namespace === null) {
                throw new \Exception('The namespace is mandatory if the entityName is given');
            }
        }

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

    /**
     * Get the content of the widget by the entity linked to it
     *
     * @param Widget $widget
     *
     * @return string
     */
    protected function getWidgetEntityContent(Widget $widget)
    {
        //the result
        $content = '';

        $entity = $widget->getEntity();

        if ($entity === null) {
            throw new \Exception('The widget ['.$widget->getId().'] has no entity to display.');
        }

        $fields = $widget->getFields();

        //test that the widget has some fields
        if (count($fields) === 0) {
            throw new \Exception('The widget ['.$widget->getId().'] has no field to display.');
        }

        //parse the field
        foreach ($fields as $field) {
            //get the value of the field
            $attributeValue =  $this->getEntityAttributeValue($entity, $field);
            //concantene values
            $content .= $attributeValue;
        }

        return $content;
    }

    /**
     * Get the generic name of the business EntityWidget
     *
     * @param Widget $widget
     *
     * @return string
     */
    protected function getWidgetGenericBusinessEntityContent(Widget $widget)
    {
        //the result
        $content = '';

        $entityName = $widget->getBusinessEntityName();

        $content = $entityName.' -> ';

        $fields = $widget->getFields();

        //test that the widget has some fields
        if (count($fields) === 0) {
            throw new \Exception('The widget ['.$widget->getId().'] has no field to display.');
        }

        //parse the field
        foreach ($fields as $field) {
            //concantene values
            $content .= $field;
        }

        return $content;
    }

    /**
     * Get the extra classes for the css
     *
     * @return string The classes
     */
    public function getExtraCssClass()
    {
        return 'vic-widget-redactor';
    }
}
