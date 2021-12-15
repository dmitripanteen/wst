<?php

namespace Wst\Component\Catalogue\Site\View\Items;

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
    protected $items = array();

    public function display($template = null)
    {
        $menu = Factory::getApplication()->getMenu()->getActive();
        $this->params = $menu->getParams();
        $this->items = $this->get('Items');
        parent::display($template);
    }

}