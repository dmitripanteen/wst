<?php

namespace Wst\Component\Catalogue\Administrator\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;


class DisplayController extends BaseController {

    protected $default_view = 'items';

    public function display($cachable = false, $urlparams = array()) {
        return parent::display($cachable, $urlparams);
    }

}