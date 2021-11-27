<?php defined( '_JEXEC' ) or die;
$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu();
$lang = JFactory::getLanguage();

$templateUrl = $this->baseurl . '/templates/' . $this->template . '/';

$isHomePage = $menu->getActive() == $menu->getDefault($lang->getTag());
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width,user-scalable=1.0"/>

    <jdoc:include type="head" />

    <link rel="stylesheet" href="<?php echo $templateUrl; ?>css/styles.css" type="text/css" />
</head>
<body>
<header>
    <nav>
        <jdoc:include type="modules" name="menu"/>
    </nav>
</header>
<div>
    <jdoc:include type="component" />
</div>
<footer></footer>
</body>
</html>