<?php

namespace Wst\Component\Catalogue\Administrator\View\Item;

defined('_JEXEC') or die;

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Wst\Component\Catalogue\Administrator\Model\ItemModel;

class HtmlView extends BaseHtmlView
{

	protected $form;
	protected $item;
	protected $state;

    /**
     * @param null $tpl
     *
     * @throws Exception
     */
	public function display($tpl = null): void
	{
        /** @var ItemModel $model */
		$model       = $this->getModel();
		$this->form  = $model->getForm();
		$this->item  = $model->getItem();
		$this->state = $model->getState();

		if (count($errors = $this->get('Errors')))
		{
			throw new GenericDataException(implode("\n", $errors), 500);
		}
		$this->addToolbar();
		parent::display($tpl);
	}

    /**
     * @throws Exception
     */
	protected function addToolbar(): void
	{
		Factory::getApplication()->input->set('hidemainmenu', true);
		$isNew      = ($this->item->id == 0);
		ToolbarHelper::title($isNew ? Text::_
        ('COM_CATALOGUE_MANAGER_ITEM_NEW') : Text::_('COM_CATALOGUE_MANAGER_ITEM_EDIT'), 'no-icon');

		$toolbarButtons = [];
        ToolbarHelper::apply('item.apply');
        $toolbarButtons[] = ['save', 'item.save'];
        $toolbarButtons[] = ['save2new', 'item.save2new'];
		if (!$isNew)
		{
			$toolbarButtons[] = ['save2copy', 'item.save2copy'];
		}
		ToolbarHelper::saveGroup(
			$toolbarButtons,
			'btn-success'
		);
		if (empty($this->item->id))
		{
			ToolbarHelper::cancel('item.cancel');
		}
		else
		{
			ToolbarHelper::cancel('item.cancel', 'JTOOLBAR_CLOSE');
		}
	}
}
