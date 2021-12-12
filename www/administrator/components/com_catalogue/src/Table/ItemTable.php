<?php

namespace Wst\Component\Catalogue\Administrator\Table;

defined('_JEXEC') or die;

use Joomla\CMS\Application\ApplicationHelper;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Table\Table;
use Joomla\Database\DatabaseDriver;

class ItemTable extends Table
{

    protected $_supportNullValue = true;
    protected $_jsonEncode = ['specifications', 'images'];

    public function __construct(DatabaseDriver $db)
    {
        $this->typeAlias = 'com_catalogue.item';
        parent::__construct('#__catalogue_item', 'id', $db);
        $this->setColumnAlias('published', 'state');
    }

    public function check()
    {
        try {
            parent::check();
        } catch (\Exception $e) {
            $this->setError($e->getMessage());

            return false;
        }

        // Set name
        $this->title = htmlspecialchars_decode($this->title, ENT_QUOTES);

        // Set alias
        if (trim($this->alias) == '') {
            $this->alias = $this->title;
        }

        $this->alias = ApplicationHelper::stringURLSafe($this->alias);

        if (trim(str_replace('-', '', $this->alias)) == '') {
            $this->alias = Factory::getDate()->format('Y-m-d-H-i-s');
        }

        // Set ordering
        if (empty($this->ordering)) {
            // Set ordering to last if ordering was 0
            $this->ordering = self::getNextOrder(
                $this->_db->quoteName('state') . ' = 1'
            );
        }

        return true;
    }

    public function store($updateNulls = true)
    {
        $db = $this->getDbo();

        if (empty($this->id)) {
            parent::store($updateNulls);
        } else {
            $oldrow = Table::getInstance(
                'ItemTable',
                __NAMESPACE__ . '\\',
                array('dbo' => $db)
            );

            if (!$oldrow->load($this->id) && $oldrow->getError()) {
                $this->setError($oldrow->getError());
            }

            $table = Table::getInstance(
                'ItemTable',
                __NAMESPACE__ . '\\',
                array('dbo' => $db)
            );

            if (
                $table->load(array('alias' => $this->alias))
                && ($table->id != $this->id || $this->id == 0)
            ) {
                $this->setError(Text::_('COM_CATALOGUE_ERROR_UNIQUE_ALIAS'));
                return false;
            }

            parent::store($updateNulls);

            if ($oldrow->state = 1) {
                $this->reorder($this->_db->quoteName('state') . ' = 1');
            }
        }

        return count($this->getErrors()) == 0;
    }
}
