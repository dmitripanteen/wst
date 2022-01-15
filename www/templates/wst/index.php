<?php defined( '_JEXEC' ) or die;

/** @var JDocumentHtml $this */
/** @var JMenuItem $currPage */

setlocale(LC_ALL, 'ru_RU.UTF-8');
$app = JFactory::getApplication();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();
$template = '/templates/'.$this->template;

$currPage =
	$menu->getActive() ?: 
	$menu->getItems('link', trim($app->input->server->getHtml('REQUEST_URI'), '/\\'), true);
if (! $currPage) $currPage = $menu->getDefault($lang->getTag());

$this->setHtml5(true);
$this->setGenerator(null);
$this->setMetaData('X-UA-Compatible', 'IE=edge');
$this->setMetaData('viewport', 'width=device-width, initial-scale=1');
$this->setMetadata('copyright', htmlspecialchars($app->get('sitename')));

$this->addFavicon($template.'/images/wst-logo.svg');
$this->addScript($template.'/assets/js/main.js?v=1');

$homepage = ($currPage == $menu->getDefault($lang->getTag()));
$user = JFactory::getUser();
?>
<!DOCTYPE html>
<html lang="<?= $this->language; ?>" dir="<?= $this->direction; ?>" xmlns:jdoc="http://www.w3.org/2001/XInclude">
<head>
	<jdoc:include type="head" />
    <jdoc:include type="modules" name="analytics"/>
</head>
<body class="<?php if(! $homepage):?>content-page<?php endif;?> page-option-<?=$app->input->get('option');?> page-view-<?=$app->input->get('view');?>">
	<div class="page-main-content<?php if ($homepage):?> homepage<?php endif;
	?>">
        <jdoc:include type="message" />
        <header>
            <div class="mobile-menu-line">
                <a class="mobile-logo" href="/">
                    <img class="header-logo"
                         src="/templates/wst/images/wst-logo.svg">
                </a>
                <button type="button" class="navbar-toggle">
                    <i class="ti ti-menu menu-open"></i>
                    <i class="ti ti-close menu-close"></i>
                </button>
            </div>
            <div id="mainmenu">
                <a class="desktop-logo" href="/">
                    <img class="header-logo"
                         src="/templates/wst/images/wst-logo.svg">
                </a>
		        <jdoc:include type="modules" name="navbar" />
            </div>
        </header>
		<jdoc:include type="modules" name="slider" />
		<?php
		$currPageSubitems = $menu->getItems('parent_id', $currPage->id);
		$currPageParent = count($currPage->tree) > 1 ? $menu->getItem($currPage->tree[0]) : null;
		$currPageSiblings = count($currPage->tree) > 1 ? $menu->getItems('parent_id', $currPageParent->id) : null;
		?>
        <jdoc:include type="modules" name="featured" />
        <jdoc:include type="component" />
	</div>
    <jdoc:include type="modules" name="pre-footer"/>
    <?php if ($homepage):?>
    <div class="homepage-art">
        <div class="brand-text">
            <span>WST</span>
        </div>
    </div>
    <?php endif;?>
	<footer>
		<div class="container">
            <jdoc:include type="modules" name="footer"/>
		</div>
	</footer>
<?php $this->addStyleSheet($template.'/assets/css/main.css?v=1');?>
</body>
</html>
