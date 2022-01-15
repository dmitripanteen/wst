<?php

namespace Wst\Component\Catalogue\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\RouterViewConfiguration;
use Joomla\CMS\Component\Router\Rules\MenuRules;
use Joomla\CMS\Component\Router\Rules\NomenuRules;
use Joomla\CMS\Menu\AbstractMenu;
use Wst\Component\Catalogue\Site\Service\Router\CatalogueStandardRules;

class Router extends RouterView
{
    protected $noIDs = false;

    /**
     * Router constructor.
     *
     * @param SiteApplication $app
     * @param AbstractMenu    $menu
     */
    public function __construct(
        SiteApplication $app,
        AbstractMenu $menu
    ) {

        $params = ComponentHelper::getParams('com_catalogue');
        $this->noIDs = (bool)($params->get('sef_ids') ?? true);

        $items = new RouterViewConfiguration('items');
        $items->setNestable(true);
        $this->registerView($items);

        $item = new RouterViewConfiguration('item');
        $item->setKey('id')->setParent($items);
        $this->registerView($item);

        $featuredHomepage = new RouterViewConfiguration('featuredhomepage');
        $this->registerView($featuredHomepage);

        parent::__construct($app, $menu);

        $this->attachRule(new MenuRules($this));
        $this->attachRule(new CatalogueStandardRules($this));
        $this->attachRule(new NomenuRules($this));
    }
}
