<?php

namespace Wst\Component\Catalogue\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Database\ParameterType;

class ItemsModel extends ListModel
{

    protected function getListQuery()
    {
        $db    = $this->getDbo();
        $query = $db->getQuery(true);
        $conditionPublished = ContentComponent::CONDITION_PUBLISHED;
        $isFeaturedOnly = $this->getState('filter.featured') ?? false;
        $query->select('*')
            ->from($db->quoteName('#__catalogue_item', 'c'))
            ->where($db->quoteName('c.state') . ' = :conditionPublished');
        if($isFeaturedOnly){
            $query->where($db->quoteName('c.featured') . ' = 1');
        }
        $query->order($db->quoteName('c.ordering') . ' ASC')
            ->bind(':conditionPublished', $conditionPublished,
                   ParameterType::INTEGER);
        $limit = (int) $this->getState('list.limit', 0);
        if($limit){
            $query->setLimit($limit);
        }
        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        return $items;
    }
}
