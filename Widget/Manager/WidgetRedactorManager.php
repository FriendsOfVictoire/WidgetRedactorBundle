<?php
namespace Victoire\Widget\RedactorBundle\Widget\Manager;

use Victoire\Bundle\CoreBundle\Entity\Widget;
use Victoire\Bundle\CoreBundle\Widget\Managers\WidgetManagerInterface;
use Victoire\Widget\TextBundle\Widget\Manager\WidgetTextManager;

/**
 * CRUD operations on WidgetRedactor Widget
 *
 * The widget view has two parameters: widget and content
 *
 * widget: The widget to display, use the widget as you wish to render the view
 * content: This variable is computed in this WidgetManager, you can set whatever you want in it and display it in the show view
 *
 * The content variable depends of the mode: static/businessEntity/entity/query
 *
 * The content is given depending of the mode by the methods:
 *  getWidgetStaticContent
 *  getWidgetBusinessEntityContent
 *  getWidgetEntityContent
 *  getWidgetQueryContent
 *
 * So, you can use the widget or the content in the show.html.twig view.
 * If you want to do some computation, use the content and do it the 4 previous methods.
 *
 * If you just want to use the widget and not the content, remove the method that throws the exceptions.
 *
 * By default, the methods throws Exception to notice the developer that he should implements it owns logic for the widget
 *
 */
class WidgetRedactorManager extends WidgetTextManager implements WidgetManagerInterface
{
    /**
     * Get the static content of the widget
     *
     * @param  Widget $widget
     * @return string The static content
     */
    protected function getWidgetStaticContent(Widget $widget)
    {
        return html_entity_decode(parent::getWidgetStaticContent($widget));
    }

    /**
     * Get the business entity content
     *
     * @param Widget $widget
     *
     * @return Ambigous <string, unknown, \Victoire\Bundle\CoreBundle\Widget\Managers\mixed, mixed>
     */
    protected function getWidgetBusinessEntityContent(Widget $widget)
    {
        return html_entity_decode(parent::getWidgetBusinessEntityContent($widget));
    }

    /**
     * Get the content of the widget for the query mode
     *
     * @param Widget $widget
     *
     * @return string The Content
     *
     * @throws \Exception
     */
    protected function getWidgetQueryContent(Widget $widget)
    {
        return html_entity_decode(parent::getWidgetQueryContent($widget));
    }

}
