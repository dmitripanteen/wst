<?php

namespace Wst\Component\Catalogue\Administrator\Service\Html;

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

class Item
{

	/**
	 * Returns a pinned state on a grid
	 *
	 * @param   integer  $value     The state value.
	 * @param   integer  $i         The row index
	 * @param   boolean  $enabled   An optional setting for access control on the action.
	 * @param   string   $checkbox  An optional prefix for checkboxes.
	 *
	 * @return  string   The Html code
	 *
	 * @see     HTMLHelperJGrid::state
	 * @since   2.5.5
	 */
	public function featured($value, $i, $enabled = true, $checkbox = 'cb')
	{
	    var_dump(1111111);
		$states = array(
			1 => array(
				'featured',
				'COM_BANNERS_BANNERS_PINNED',
				'COM_BANNERS_BANNERS_HTML_PIN_BANNER',
				'COM_BANNERS_BANNERS_PINNED',
				true,
				'publish',
				'publish'
			),
			0 => array(
				'sticky_publish',
				'COM_BANNERS_BANNERS_UNPINNED',
				'COM_BANNERS_BANNERS_HTML_UNPIN_BANNER',
				'COM_BANNERS_BANNERS_UNPINNED',
				true,
				'unpublish',
				'unpublish'
			),
		);

		return HTMLHelper::_('jgrid.state', $states, $value, $i, 'items.', $enabled, true, $checkbox);
	}
}
