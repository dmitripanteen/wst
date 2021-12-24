<?php

defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Router\Route;
$bgImage = $this->params->get('bg_image');
?>
<div id="slider" class="article-slider">
    <div class="slide"
         style="background-image:url('<?php echo
         substr($bgImage, 0, strpos($bgImage, '#'))
         ?>')">
    </div>
</div>
<div class="catalogue-body">
    <div class="items">
        <?php foreach ($this->items as $item): ?>
            <?php foreach (json_decode($item->images) as $image) {
                if ($image->is_main_image) {
                    $mainImage
                        = substr($image->url, 0, strpos($image->url, '#'));
                }
            }
            $mainImage = $mainImage
                ?: substr(
                    $image->url,
                    0,
                    strpos($image->url, '#')
                );?>
            <a href="<?php echo Route::_('index.php?option=com_catalogue&view=item&id='.$item->id);?>"
            class="catalogue-item">
                <div class="item-image">
                    <img src="<?php echo $mainImage; ?>">
                </div>
                <div class="item-title">
                    <?php echo $item->catalogue_name; ?><br>
                    <?php echo $item->catalogue_subheader; ?>
                </div>
            </a>
        <?php endforeach; ?>
        <?php if(count($this->items)%3):?>
            <div class="catalogue-item invisible"></div>
            <?php if(count($this->items)%3==1):?>
                <div class="catalogue-item invisible"></div>
            <?php endif;?>
        <?php endif;?>
    </div>
</div>