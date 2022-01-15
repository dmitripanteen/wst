<?php

defined('_JEXEC') or die;

use Joomla\CMS\Language\Text;

?>
<div class="footer-col">
    <p class="footer-headline"><?php if($params->get('link1_url')){?>
        <a href="<?php echo $params->get('link1_url');?>">
            <?php echo $params->get('link1_text');?>
        </a>
        <?php } else {?>
        <?php echo $params->get('link1_text'); ?></p>
    <?php }?>
    <div class="extra"><?php echo $params->get('link1_extra_text'); ?></div>
</div>
<div class="footer-col">
    <p class="footer-headline"><?php if($params->get('link2_url')){?>
            <a href="<?php echo $params->get('link2_url');?>">
                <?php echo $params->get('link2_text');?>
            </a>
        <?php } else {?>
        <?php echo $params->get('link2_text'); ?></p>
    <?php }?>
    <div class="extra"><?php echo $params->get('link2_extra_text'); ?></div>
</div>
<div class="footer-col">
    <p class="footer-headline"><?php if($params->get('link3_url')){?>
            <a href="<?php echo $params->get('link3_url');?>">
                <?php echo $params->get('link3_text');?>
            </a>
        <?php } else {?>
        <?php echo $params->get('link3_text'); ?></p>
    <?php }?>
    <div class="extra"><?php echo $params->get('link3_extra_text'); ?></div>
</div>
<div class="footer-col">
    <p class="footer-headline"><?php if($params->get('link4_url')){?>
            <a href="<?php echo $params->get('link4_url');?>">
                <?php echo $params->get('link4_text');?>
            </a>
        <?php } else {?>
        <?php echo $params->get('link4_text'); ?></p>
    <?php }?>
    <div class="extra"><?php echo $params->get('link4_extra_text'); ?></div>
</div>