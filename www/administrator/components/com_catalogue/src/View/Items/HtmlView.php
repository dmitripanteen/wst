<?php

namespace Wst\Component\Catalogue\Administrator\View\Items;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\View\GenericDataException;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use Joomla\CMS\Toolbar\Toolbar;
use Joomla\CMS\Toolbar\ToolbarHelper;
use Wst\Component\Catalogue\Administrator\Model\ItemsModel;
use Joomla\CMS\Language\Text;

class HtmlView extends BaseHtmlView
{

    protected $items = [];
    protected $pagination;
    protected $state;
    private $isEmptyState = false;

    function display($tpl = null)
    {
        /** @var ItemsModel $model */
        $model = $this->getModel();
        $this->items = $model->getItems();
        $this->pagination = $model->getPagination();
        $this->state = $model->getState();

        if (
            !count($this->items)
            && $this->isEmptyState = $this->get('IsEmptyState')
        ) {
            $this->setLayout('emptystate');
        }

        if (count($errors = $this->get('Errors'))) {
            throw new GenericDataException(implode("\n", $errors), 500);
        }
        $this->addToolbar();

        parent::display($tpl);
    }

    protected function addToolbar(): void
    {
        $toolbar = Toolbar::getInstance('toolbar');
        ToolbarHelper::title(Text::_('COM_CATALOGUE_MANAGER_ITEMS'), 'no-icon');
        $toolbar->addNew('item.add');
        $toolbar->preferences('com_catalogue');
    }

}