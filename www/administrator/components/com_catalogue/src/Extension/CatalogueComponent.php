<?php

namespace Wst\Component\Catalogue\Administrator\Extension;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Component\Router\RouterServiceInterface;
use Joomla\CMS\Component\Router\RouterServiceTrait;
use Joomla\CMS\Extension\BootableExtensionInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\HTML\HTMLRegistryAwareTrait;
use Psr\Container\ContainerInterface;
use Wst\Component\Catalogue\Administrator\Service\Html\Item;

class CatalogueComponent extends MVCComponent implements BootableExtensionInterface, RouterServiceInterface
{
	use HTMLRegistryAwareTrait;
	use RouterServiceTrait;

	public function boot(ContainerInterface $container)
	{
		$this->getRegistry()->register('item', new Item);
	}

	protected function getTableNameForSection(string $section = null)
	{
		return 'catalogue_item';
	}
}
