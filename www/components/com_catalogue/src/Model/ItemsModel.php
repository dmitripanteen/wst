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

        $query->select('*')
            ->from($db->quoteName('#__catalogue_item', 'c'))
            ->where($db->quoteName('c.state') . ' = :conditionPublished')
            ->order($db->quoteName('c.ordering') . ' ASC')
            ->bind(':conditionPublished', $conditionPublished,
                   ParameterType::INTEGER);
        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        return $items;
    }
}
