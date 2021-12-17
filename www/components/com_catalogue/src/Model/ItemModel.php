<?php

namespace Wst\Component\Catalogue\Site\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\ItemModel as BaseItemModel;
use Joomla\Component\Content\Administrator\Extension\ContentComponent;
use Joomla\Database\ParameterType;
use Joomla\CMS\Language\Text;

class ItemModel extends BaseItemModel
{

    protected function populateState()
    {
        $app = Factory::getApplication();
        $pk = $app->input->getInt('id');
        $this->setState('catalogueItem.id', $pk);
    }

    public function getItem($pk = null)
    {
        $pk = (int)($pk ?: $this->getState('catalogueItem.id'));

        if ($this->_item === null) {
            $this->_item = array();
        }

        if (!isset($this->_item[$pk])) {
            try {
                $conditionPublished = ContentComponent::CONDITION_PUBLISHED;
                $db = $this->getDbo();
                $query = $db->getQuery(true);

                $query->select('*')
                    ->from($db->quoteName('#__catalogue_item', 'c'))
                    ->where(
                        [
                            $db->quoteName('c.id') . ' = :pk',
                            $db->quoteName('c.state') .
                            ' = :conditionPublished',
                        ]
                    )
                    ->bind(':pk', $pk, ParameterType::INTEGER)
                    ->bind(
                        ':conditionPublished',
                        $conditionPublished,
                        ParameterType::INTEGER
                    );

                $db->setQuery($query);
                $data = $db->loadObject();

                if (empty($data)) {
                    throw new \Exception(
                        Text::_('COM_CATALOGUE_ERROR_ITEM_NOT_FOUND'), 404
                    );
                }
                $this->_item[$pk] = $data;
            } catch (\Exception $e) {
                if ($e->getCode() == 404) {
                    throw $e;
                } else {
                    $this->setError($e);
                    $this->_item[$pk] = false;
                }
            }
        }
        return $this->_item[$pk];
    }
}
