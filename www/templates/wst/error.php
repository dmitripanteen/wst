<?php defined('_JEXEC') or die;

use Joomla\CMS\Factory;
/** @var JDocumentError $this */

$templateUrl = $this->baseurl . '/templates/' . $this->template . '/';
$this->addScript($templateUrl . '/assets/js/main.js?v=1');
$document = Factory::getDocument();
$document->setTitle('Страница не найдена');
?>
<!DOCTYPE html>
<html lang="<?= $this->language; ?>" dir="<?= $this->direction; ?>"
      xmlns:jdoc="http://www.w3.org/2001/XInclude">
<head>
    <jdoc:include type="head"/>
</head>
<body class="content-page">
<div class="page-main-content">
    <header>
        <div id="mainmenu">
            <a href="/">
                <img class="header-logo"
                     src="/templates/wst/images/wst-logo.svg">
            </a>
            <jdoc:include type="modules" name="navbar"/>
        </div>
    </header>
    <div class="page-404">
        <div class="image-404">
            <img src="/images/404-image.png">
        </div>
        <div class="text-404">
            <h2>404</h2>
            <div class="text-inner main">
                Страница не найдена!
            </div>
            <div class="text-inner">
                Возможно, вы набрали что-то неправильно в адресной строке<br>
                или страница была перемещена.
            </div>
            <div class="text-inner link">
                <a href="/">На главную</a>
            </div>
            <?php if ($this->debug): ?>
                <div>
                    <?=JText::_('JERROR_ERROR');?> <?=$this->error->getCode();?>: <?=$this->error->getMessage();?>
                    <pre style="white-space: pre-line;">
                                    Erorr <?=$this->error->getCode();?>: <?=$this->error->getMessage();?><br>
                                    File: <?=$this->error->getFile();?> (<?=$this->error->getLine();?>)<br>
                        <?=$this->error->getTraceAsString();?>
		                    </pre>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<jdoc:include type="modules" name="pre-footer"/>
<footer>
    <div class="container">
        <jdoc:include type="modules" name="footer"/>
    </div>
</footer>
<?php $this->addStyleSheet($templateUrl . '/assets/css/main.css?v=1'); ?>
</body>
</html>
