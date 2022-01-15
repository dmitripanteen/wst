<?php
const _JEXEC = 1;
$DOCUMENT_ROOT = __DIR__.'/www';

if (file_exists($DOCUMENT_ROOT.'/defines.php')){
	require_once $DOCUMENT_ROOT.'/defines.php';
}
if (!defined('_JDEFINES')){
	define('JPATH_BASE', $DOCUMENT_ROOT);
	require_once JPATH_BASE.'/includes/defines.php';
}
require_once JPATH_LIBRARIES.'/import.legacy.php';
require_once JPATH_LIBRARIES.'/cms.php';
require_once JPATH_CONFIGURATION.'/configuration.php';

$jconfig = JFactory::getConfig(JPATH_CONFIGURATION.'/configuration.php');


return array(
	'paths' => array(
		'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
		'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds',
	),
	'environments' => array(
		'default_migration_table' => '_phinxlog',
		'default_database' => 'dev',
		'dev' => array(
			'adapter' => 'mysql',
			'host' => $jconfig->get('host'),
			'port' => '3306',
			'name' => $jconfig->get('db'),
			'user' => $jconfig->get('user'),
			'pass' => $jconfig->get('password'),
			'charset' => 'utf8',
			'table_prefix' => $jconfig->get('dbprefix'),
		),
	),
	'version_order' => 'creation',
);
