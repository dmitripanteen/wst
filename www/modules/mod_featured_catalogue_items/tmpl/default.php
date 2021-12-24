<?php

defined('_JEXEC') or die;

use Joomla\CMS\Router\Route;

?>
<div class="catalogue-body homepage">
    <div class="items featured">
        <?php foreach ($items as $item): ?>
            <?php foreach (json_decode($item->images) as $image) {
                if ($image->is_main_image) {
                    $mainImage
                        = substr($image->url, 0, strpos($image->url, '#'));
                    break;
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
                <div class="item-title">
                    <?php echo $item->featured_description; ?>
                </div>
                <div class="item-image">
                    <img src="<?php echo $mainImage; ?>">
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
