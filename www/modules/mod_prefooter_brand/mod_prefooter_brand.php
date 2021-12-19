<?php

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

$logo = $params->get('logo');
$logo = substr($logo, 0, strpos($logo, '#'));
$brandText = trim($params->get('brand-text'));

require ModuleHelper::getLayoutPath('mod_prefooter_brand', $params->get('layout', 'default'));
