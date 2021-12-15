<?php

namespace Wst\Component\Catalogue\Site\Controller;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;

class DisplayController extends BaseController
{

    public function __construct($config = array(), MVCFactoryInterface $factory = null, $app = null, $input = null)
    {
        $this->input = Factory::getApplication()->input;

        parent::__construct($config, $factory, $app, $input);
    }

    public function display($cachable = false, $urlparams = array())
    {
        $document = Factory::getDocument();
        $viewName = $this->input->getCmd('view', 'items');
        $viewFormat = $document->getType();
        $this->input->set('view', $viewName);

        $view = $this->getView($viewName, $viewFormat);
        $view->setModel($this->getModel('Items'), true);

        $view->document = $document;
        $view->display();
    }

}