<?php

namespace Wst\Component\Catalogue\Site\Service;

defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\Rules\RulesInterface;
use Joomla\CMS\Factory;

class CatalogueNomenuRules implements RulesInterface
{

    protected $router;
    public function __construct(RouterView $router)
    {
        $this->router = $router;
    }


    public function preprocess(&$query)
    {
    }

    public function parse(&$segments, &$vars)
    {
        $vars = [
            'view' => 'items',
        ];
        $count = count($segments);
        if($count == 1) {
            $vars['id'] = (int) $this->getItemIdByAlias($segments[0]);
        }
        if($vars['id']){
            $vars['view'] = 'item';
        }
        return;
    }

    public function build(&$query, &$segments)
    {
        $segments = [];

        if (!empty($query['id'])) {
            $segments[] = $this->getItemAlias((int) $query['id']);
            unset( $query['id'] );
        };
        unset($query['view']);
        return;
    }

    private function getItemAlias($id){
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('alias')
            ->from('#__catalogue_item')
            ->where('id='.$id);
        $db->setQuery($query);
        $alias = $db->loadResult();
        return $alias;
    }

    private function getItemIdByAlias($alias){
        $db = Factory::getDbo();
        $query = $db->getQuery(true)
            ->select('id')
            ->from('#__catalogue_item')
            ->where('alias='.$db->quote($alias));
        $db->setQuery($query);
        $id = $db->loadResult();
        return $id;
    }
}
