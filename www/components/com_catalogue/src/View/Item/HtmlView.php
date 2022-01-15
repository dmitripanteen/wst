<?php

namespace Wst\Component\Catalogue\Site\View\Item;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;

class HtmlView extends BaseHtmlView
{
    /**
     * @var \Joomla\Registry\Registry|null
     */
    protected $params;

    /**
     * @var \stdClass[]
     */
    protected $item = array();

    public function display($template = null)
    {
        $menu = Factory::getApplication()->getMenu()->getActive();
        $this->params = $menu->getParams();
        $this->item = $this->get('Item');
        $this->item->images = json_decode($this->item->images);
        $this->item->specifications = json_decode($this->item->specifications);

        $this->setDocumentTitle($this->item->title);

        parent::display($template);
    }

}