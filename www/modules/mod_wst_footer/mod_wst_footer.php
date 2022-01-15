<?php

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

require ModuleHelper::getLayoutPath(
    'mod_wst_footer',
    $params->get('layout', 'default')
);
