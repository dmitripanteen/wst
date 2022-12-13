<?php

defined('_JEXEC') or die('Restricted Access');
?>
<div class="catalogue-body single-item">
    <h2 class="item-title-mobile"><?php echo $this->item->title;?></h2>
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
            <div class="link-section">
                <p class="link-title">Для розничных покупателей</p>
                <a class="link"
                   href="https://4restik.com/"
                   target="_blank"
                >
                    <i class="ti ti-shopping-cart"></i>
                    <span>купить</span>
                </a>
            </div>
            <div class="link-section">
                <p class="link-title">Для оптовых покупателей</p>
                <p>
                    <a class="text-link"
                       href="mailto:sales@wst-russia.ru"
                       target="_blank"
                    >sales@wst-russia.ru</a>
                </p>
                <p>
                    <a class="text-link"
                       href="tel:+74955057293"
                       target="_blank"
                    >+7 (495) 505-72-93</a>
                </p>
            </div>
        </div>
    </div>
</div>