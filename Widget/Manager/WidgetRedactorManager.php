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
     * Get the static content of the widget
     *
     * @param Widget $widget
     * @return string The static content
     */
    protected function getWidgetStaticContent(Widget $widget)
    {
        $content = $widget->getContent();

        return $content;
    }

    /**
     * Get the business entity content
     * @param Widget $widget
     * @return Ambigous <string, unknown, \Victoire\Bundle\CoreBundle\Widget\Managers\mixed, mixed>
     */
    protected function getWidgetBusinessEntityContent(Widget $widget)
    {
        //get the entity
        $entity = $widget->getEntity();

        //display a generic content if no entity were specified
        if ($entity === null) {
            $content = $this->getWidgetGenericBusinessEntityContent($widget);
        } else {
            //get the content of the widget with its entity
            $content = $this->getWidgetEntityContent($widget);
        }

        return $content;
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
     * Get the content of the widget for the query mode
     *
     * @param Widget $widget
     * @throws \Exception
     */
    protected function getWidgetQueryContent(Widget $widget)
    {
        throw new \Exception('The mode ['.$mode.'] is not yet supported by the widget manager. Widget ID:['.$widget->getId().']');
    }


    /**
     * The name of the widget
     *
     * @return string
     */
    public function getWidgetName()
    {
        return 'redactor';
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
}
