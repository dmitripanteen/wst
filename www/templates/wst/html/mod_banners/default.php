<?php

defined('_JEXEC') or die;

/** @var stdClass[] $list */
?>

<div id="slider">
    <?php foreach ($list as $item): ?>
        <?php if ($item->type === 1): ?>
            <div class="slide">
                <?= $item->custombannercode; ?>
            </div>
        <?php else: ?>
            <div class="slide"
                 style="background-image:url('<?= $item->params->get(
                     'imageurl'
                 ); ?>')">
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
</div>