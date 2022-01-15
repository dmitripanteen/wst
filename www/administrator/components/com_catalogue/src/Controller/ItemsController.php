<?php

namespace Wst\Component\Catalogue\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\AdminController;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class ItemsController extends AdminController
{

    protected $text_prefix = 'COM_CATALOGUE_ITEMS';

    public function __construct(
        $config = array(),
        MVCFactoryInterface $factory = null,
        $app = null,
        $input = null
    ) {
        parent::__construct($config, $factory, $app, $input);
    }

    public function getModel(
        $name = 'Item',
        $prefix = 'Administrator',
        $config = array('ignore_request' => true)
    ) {
        return parent::getModel($name, $prefix, $config);
    }
}
