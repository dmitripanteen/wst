<?php

namespace Wst\Component\Catalogue\Site\Service\Router;

defined('_JEXEC') or die;

use Joomla\CMS\Component\Router\RouterView;
use Joomla\CMS\Component\Router\Rules\RulesInterface;
use Joomla\CMS\Factory;
use Joomla\Database\DatabaseDriver;

class CatalogueStandardRules implements RulesInterface
{
    /**
     * @var RouterView
     */
    protected $router;

    /**
     * @var DatabaseDriver
     */
    protected $db;

    /**
     * CatalogueStandardRules constructor.
     *
     * @param RouterView $router
     */
    public function __construct(RouterView $router)
    {
        $this->router = $router;
        $this->db = Factory::getContainer()->get('DatabaseDriver');
    }

    public function preprocess(&$query)
    {
    }

    public function parse(&$segments, &$vars)
    {
        switch ($segments[0]) {
            case 'items':
                $vars['view'] = 'items';
                break;
            case 'featuredhomepage':
                $vars['view'] = 'featuredhomepage';
                break;
            case 'item':
                $vars['view'] = 'item';
                $vars['id'] = $this->getItemIdByAlias($segments[1]);
                break;
        }
        array_shift($segments);
        array_shift($segments);
        return;
    }

    public function build(&$query, &$segments)
    {
        if (isset($query['view'])) {
            if (
                $query['view'] == 'featuredhomepage'
                || $query['view'] == 'items'
            ) {
                $segments[] = '';
            } else {
                $segments[] = $query['view'];
            }
            unset($query['view']);
        }
        if (isset($query['id'])) {
            $segments[] = $this->getItemAliasById((int)$query['id']);
            unset($query['id']);
        };
    }

    private function getItemAliasById($id)
    {
        $query = $this->db->getQuery(true)
            ->select('alias')
            ->from('#__catalogue_item')
            ->where('id = ' . $id);
        $this->db->setQuery($query);
        return $this->db->loadResult();
    }

    private function getItemIdByAlias($alias)
    {
        $query = $this->db->getQuery(true)
            ->select('id')
            ->from('#__catalogue_item')
            ->where('alias = ' . $this->db->q($alias));
        $this->db->setQuery($query);
        return $this->db->loadResult();
    }
}