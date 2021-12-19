<?php

namespace Wst\Module\FeaturedCatalogueItems\Site\Helper;

defined('_JEXEC') or die;

use Joomla\Registry\Registry;
use Wst\Component\Catalogue\Site\Model\ItemsModel;

class CatalogueHelper
{
	public static function getList(Registry $params, ItemsModel $model)
	{
		$model->setState('filter.featured', true);
		$model->setState('list.limit', (int) $params->get('items_count', 1));
		return $model->getItems();
	}
}
