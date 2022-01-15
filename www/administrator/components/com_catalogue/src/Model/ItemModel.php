<?php

namespace Wst\Component\Catalogue\Administrator\Model;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Model\AdminModel;

class ItemModel extends AdminModel
{

    protected $text_prefix = 'COM_CATALOGUE_ITEM';

    public $typeAlias = 'com_catalogue.item';

    public function getForm($data = array(), $loadData = true)
    {
        $form = $this->loadForm(
            'com_catalogue.item',
            'item',
            array('control' => 'jform', 'load_data' => $loadData)
        );
        if (empty($form)) {
            return false;
        }
        $form->setFieldAttribute('ordering', 'disabled', 'true');
        $form->setFieldAttribute('ordering', 'filter', 'unset');
        return $form;
    }

    protected function loadFormData()
    {
        $app = Factory::getApplication();
        $data = $app->getUserState('com_catalogue.edit.item.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }
        $this->preprocessData('com_catalogue.item', $data);
        return $data;
    }

    protected function getReorderConditions($table)
    {
        return [
            $this->_db->quoteName('state') . ' = 1',
        ];
    }

    protected function prepareTable($table)
    {
        if (empty($table->id)) {
            if (empty($table->ordering)) {
                $db = $this->getDbo();
                $query = $db->getQuery(true)
                    ->select('MAX(' . $db->quoteName('ordering') . ')')
                    ->from($db->quoteName('#__catalogue_item'));
                $db->setQuery($query);
                $max = $db->loadResult();
                $table->ordering = $max + 1;
            }
        }
    }

    public function save($data)
    {
        $input = Factory::getApplication()->input;
        if ($input->get('task') == 'save2copy') {
            $origTable = clone $this->getTable();
            $origTable->load($input->getInt('id'));

            if ($data['name'] == $origTable->name) {
                list(
                    $name, $alias
                    ) =
                    $this->generateNewTitle(
                        null,
                        $data['alias'],
                        $data['name']
                    );
                $data['name'] = $name;
                $data['alias'] = $alias;
            } else {
                if ($data['alias'] == $origTable->alias) {
                    $data['alias'] = '';
                }
            }
            $data['state'] = 0;
        }
        return parent::save($data);
    }
}
