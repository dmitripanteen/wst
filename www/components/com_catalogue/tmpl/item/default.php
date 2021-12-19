<?php

defined('_JEXEC') or die('Restricted Access');
?>
<div class="catalogue-body single-item">
    <div class="images">
        <ul id="catalogue-slider" class="gallery">
            <?php foreach ($this->item->images as $image):?>
                <li data-thumb="/<?php echo substr($image->url, 0, strpos($image->url, '#'));?>">
                    <a href="#">
                        <img src="/<?php echo substr($image->url, 0, strpos($image->url, '#'));?>"/>
                    </a>
                </li>
            <?php endforeach;?>
        </ul>
    </div>
    <div class="item-data">
        <h2><?php echo $this->item->title;?></h2>
        <div class="description">
            <?php echo $this->item->description;?>
        </div>
        <div class="specifications">
            <?php foreach ($this->item->specifications as $specification):?>
            <div class="specification">
                <div class="sp-title"><?php echo $specification->name;?></div>
                <?php if ($specification->value):?>
                : <div class="sp-descr">
                    <?php echo $specification->value;?>
                </div>
                <?php endif;?>
            </div>
            <?php endforeach;?>
        </div>
        <div class="links">
            <a class="link ozon-link"
               href="<?php echo $this->item->ozon_link ?: 'https://www.ozon.ru/';?>"
               target="_blank">
                <i class="ti ti-shopping-cart"></i>
                <span>ozon</span>
            </a>
            <a class="link wildberries-link"
               href="<?php echo $this->item->wildberries_link ?: 'https://www.wildberries.ru/';?>"
               target="_blank">
                <i class="ti ti-shopping-cart"></i>
                <span>wildberries</span>
            </a>
            <a class="link aliexpress-link"
               href="<?php echo $this->item->aliexpress_link ?: 'https://best.aliexpress.ru/?lan=ru';?>"
               target="_blank">
                <i class="ti ti-shopping-cart"></i>
                <span>aliexpress</span>
            </a>
            <a class="link cdek-link"
               href="<?php echo $this->item->cdek_link ?: 'https://cdek.market/';?>"
               target="_blank">
                <i class="ti ti-shopping-cart"></i>
                <span>cdek.market</span>
            </a>
        </div>
    </div>
</div>