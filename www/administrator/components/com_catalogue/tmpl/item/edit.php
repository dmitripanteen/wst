<?php

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;

/** @var \Wst\Component\Catalogue\Administrator\View\Item\HtmlView; $this */

/** @var Joomla\CMS\WebAsset\WebAssetManager $wa */
$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
	//->useScript('com_banners.admin-banner-edit');

?>
<style>
    .form-control.width-100{
        width: 100%;
    }
    #fieldset-images table thead tr th:first-of-type{
        width: 0 !important;
    }
</style>
<form action="<?php echo Route::_('index.php?option=com_catalogue&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="cataloge-item-form" aria-label="<?php echo Text::_('COM_CATALOGUE_ITEM_FORM_' . ((int) $this->item->id === 0 ? 'NEW' : 'EDIT'), true); ?>" class="form-validate">

	<?php echo LayoutHelper::render('joomla.edit.title_alias', $this); ?>

	<div class="main-card">
		<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', ['active' => 'details', 'recall' => true, 'breakpoint' => 768]); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'details', Text::_('COM_CATALOGUE_ITEM_DETAILS')); ?>
		<div class="row">
            <?php echo $this->form->renderFieldset('details'); ?>
		</div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'extra_data', Text::_('COM_CATALOGUE_ITEM_EXTRA_DATA')); ?>
        <div class="row">
            <?php echo $this->form->renderField('ozon_link'); ?>
            <?php echo $this->form->renderField('wildberries_link'); ?>
            <?php echo $this->form->renderField('aliexpress_link'); ?>
            <?php echo $this->form->renderField('cdek_link'); ?>
            <fieldset id="fieldset-extra-data">
                <?php echo $this->form->renderField('specifications'); ?>
            </fieldset>
        </div>
		<?php echo HTMLHelper::_('uitab.endTab'); ?>

        <?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'images', Text::_('COM_CATALOGUE_ITEM_IMAGES')); ?>
        <div class="row">
            <fieldset id="fieldset-images">
                <?php echo $this->form->renderField('images'); ?>
            </fieldset>
        </div>
        <?php echo HTMLHelper::_('uitab.endTab'); ?>

		<?php echo HTMLHelper::_('uitab.endTabSet'); ?>
	</div>

	<input type="hidden" name="task" value="">
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
