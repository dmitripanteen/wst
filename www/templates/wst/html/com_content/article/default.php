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
    <div class="article-image">
        <img src="<?php echo
        substr(
            $images->image_fulltext,
            0,
            strpos(
                $images->image_fulltext,
                '#'
            )
        )
        ?>">
    </div>
    <div class="article-text">
        <?php echo $this->item->text; ?>
    </div>
</div>