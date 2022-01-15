<?php

namespace Wst\Component\Catalogue\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Table\Table;
use Joomla\Database\ParameterType;

class ItemsModel extends ListModel
{

    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'c.id',
                'title',
                'c.title',
                'alias',
                'c.alias',
                'state',
                'c.state',
                'ordering',
                'c.ordering',
                'featured',
                'c.featured',
            );
        }

        parent::__construct($config);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  \JDatabaseQuery
     *
     * @since   1.6
     */
    protected function getListQuery()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query->select(
            $this->getState(
                'list.select',
                [
                    $db->quoteName('c.id'),
                    $db->quoteName('c.title'),
                    $db->quoteName('c.alias'),
                    $db->quoteName('c.state'),
                    $db->quoteName('c.ordering'),
                    $db->quoteName('c.featured'),
                ]
            )
        )
            ->from($db->quoteName('#__catalogue_item', 'c'));

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering', 'c.ordering');
        $orderDirn = $this->state->get('list.direction', 'ASC');

        $query->order($db->escape($orderCol) . ' ' . $db->escape($orderDirn));

        return $query;
    }

    public function getTable(
        $type = 'Item',
        $prefix = 'Administrator',
        $config = array()
    ) {
        return parent::getTable($type, $prefix, $config);
    }

    protected function populateState($ordering = 'c.ordering', $direction = 'asc')
    {
        $this->setState('params', ComponentHelper::getParams('com_catalogue'));
        parent::populateState($ordering, $direction);
    }
}
