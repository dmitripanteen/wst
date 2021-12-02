<?php

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Component\Content\Site\Helper\RouteHelper;

$params = JFactory::getApplication()->getMenu()->getActive()->getParams();
$images = json_decode($this->item->images);
?>
<div id="slider" class="article-slider">
    <div class="slide"
         style="background-image:url('<?php echo
         substr($images->image_intro, 0, strpos($images->image_intro, '#'))
         ?>')">
    </div>
</div>
<div class="article <?php echo $this->pageclass_sfx; ?>">
    <div class="contact-data">
        <div class="item">
            <?php if ($params->get('phone')): ?>
                <i class="fa fa-phone"></i>
                <p><?php echo $params->get('phone'); ?></p>
            <?php endif; ?>
        </div>
        <div class="item">
            <?php if ($params->get('email')): ?>
                <i class="fa fa-at"></i>
                <p><?php echo $params->get('email'); ?></p>
            <?php endif; ?>
        </div>
        <div class="item">
            <?php if ($params->get('address')): ?>
                <i class="fa fa-map-marker"></i>
                <p><?php echo $params->get('address'); ?></p>
            <?php endif; ?>
        </div>
    </div>
    <div class="contact-map">
        <?php if ($params->get('map')): ?>
            <?php echo $params->get('map');?>
        <?php endif; ?>
    </div>
</div>