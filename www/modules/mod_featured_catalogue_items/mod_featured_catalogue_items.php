<?php

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Wst\Module\FeaturedCatalogueItems\Site\Helper\CatalogueHelper;

$model = $app->bootComponent('com_catalogue')->getMVCFactory()->createModel('Items', 'Site', ['ignore_request' => true]);
$items  = CatalogueHelper::getList($params, $model);

require ModuleHelper::getLayoutPath('mod_featured_catalogue_items', $params->get('layout', 'default'));
