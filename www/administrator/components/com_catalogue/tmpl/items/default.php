<?php

defined('_JEXEC') or die('Restricted Access');

use Joomla\CMS\Router\Route;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;
HTMLHelper::_('behavior.multiselect');

$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$saveOrder = $listOrder == 'a.ordering';

if ($saveOrder && !empty($this->items))
{
    $saveOrderingUrl = 'index.php?option=com_catalogue&task=items.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
    HTMLHelper::_('draggablelist.draggable');
}
?>
<form action="<?php echo Route::_('index.php?option=com_catalogue&view=items'); ?>" method="post" name="adminForm" id="adminForm">
    <div class="row">
        <div class="col-md-12">
            <div id="j-main-container" class="j-main-container">
                <?php if (empty($this->items)) : ?>
                    <div class="alert alert-info">
                        <span class="icon-info-circle" aria-hidden="true"></span><span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
                        <?php echo Text::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                    </div>
                <?php else : ?>
                <table class="table" id="articleList">
                    <caption class="visually-hidden">
                        <?php echo Text::_('COM_CATALOGUE_ITEMS_TABLE_CAPTION');?>,
                        <span id="orderedBy"><?php echo Text::_('JGLOBAL_SORTED_BY'); ?> </span>,
                        <span id="filteredBy"><?php echo Text::_('JGLOBAL_FILTERED_BY'); ?></span>
                    </caption>
                    <thead>
                        <tr>
                            <td class="w-1 text-center">
                                <?php echo HTMLHelper::_('grid.checkall'); ?>
                            </td>
                            <th scope="col" class="w-1 text-center d-none d-md-table-cell">
                                <?php echo HTMLHelper::_('searchtools.sort', '', 'c.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-sort'); ?>
                            </th>
                            <th scope="col" class="w-1 text-center">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'c.state', $listDirn, $listOrder); ?>
                            </th>
                            <th scope="col">
                                <?php echo HTMLHelper::_('searchtools.sort', 'COM_CATALOGUE_HEADING_NAME', 'c.title', $listDirn, $listOrder); ?>
                            </th>
                            <th scope="col" class="w-10 text-center d-none d-md-table-cell">
                                <?php echo HTMLHelper::_('searchtools.sort', 'COM_CATALOGUE_HEADING_FEATURED', 'featured', $listDirn, $listOrder); ?>
                            </th>
                            <th scope="col" class="w-10 d-none d-md-table-cell">
                                <?php echo HTMLHelper::_('searchtools.sort', 'JGRID_HEADING_ID', 'c.id', $listDirn, $listOrder); ?>
                            </th>
                        </tr>
                    </thead>
                    <tbody <?php if ($saveOrder) :?> class="js-draggable" data-url="<?php echo $saveOrderingUrl; ?>" data-direction="<?php echo strtolower($listDirn); ?>" data-nested="true"<?php endif; ?>>
                    <?php foreach ($this->items as $i => $item) :
                        $ordering  = ($listOrder == 'ordering');
                        ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="text-center">
                                <?php echo HTMLHelper::_('grid.id', $i,
                                                         $item->id, false, 'cid', 'cb', $item->title); ?>
                            </td>
                            <td class="text-center d-none d-md-table-cell">
                                <?php
                                $iconClass = '';
                                if (!$saveOrder)
                                {
                                    $iconClass = ' inactive" title="' . Text::_('JORDERINGDISABLED');
                                }
                                ?>
                                <span class="sortable-handler <?php echo $iconClass ?>">
											<span class="icon-ellipsis-v" aria-hidden="true"></span>
										</span>
                                <?php if ($saveOrder) : ?>
                                    <input type="text" name="order[]" size="5"
                                           value="<?php echo $item->ordering; ?>" class="width-20 text-area-order hidden">
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <?php echo HTMLHelper::_('jgrid.published', $item->state, $i, 'items.'); ?>
                            </td>
                            <th scope="row">
                                <div class="break-word">
                                    <a href="<?php echo Route::_('index.php?option=com_catalogue&task=item.edit&id=' . (int) $item->id); ?>" title="<?php echo Text::_('JACTION_EDIT'); ?> <?php echo $this->escape($item->title); ?>"><?php echo $this->escape($item->title); ?></a>
                                    <div class="small break-word">
                                        <?php echo Text::sprintf('JGLOBAL_LIST_ALIAS', $this->escape($item->alias)); ?>
                                    </div>
                                </div>
                            </th>
                            <td class="text-center d-none d-md-table-cell">
                                <?php if($item->featured):?>
                                    <span class="icon-publish"></span>
                                <?php else:?>
                                    <span class="icon-unpublish"></span>
                                <?php endif;?>
                            </td>
                            <td class="d-none d-md-table-cell">
                                <?php echo $item->id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php echo $this->pagination->getListFooter(); ?>
                <?php endif;?>
                <input type="hidden" name="task" value="">
                <input type="hidden" name="boxchecked" value="0">
                <?php echo HTMLHelper::_('form.token'); ?>
            </div>
        </div>
    </div>
</form>