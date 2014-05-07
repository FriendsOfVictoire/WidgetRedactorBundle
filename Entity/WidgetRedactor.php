<?php
namespace Victoire\RedactorBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Victoire\TextBundle\Entity\WidgetText;

/**
 * WidgetText
 *
 * @ORM\Table("cms_widget_redactor")
 * @ORM\Entity
 */
class WidgetRedactor extends WidgetText
{
    use \Victoire\Bundle\CoreBundle\Entity\Traits\WidgetTrait;
}
