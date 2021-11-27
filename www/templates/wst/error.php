<?php defined('_JEXEC') or die;

/** @var JDocumentError $this */

$template_url = $this->baseurl.'/templates/'.$this->template.'/';
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <base href="/" />
    <meta name="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="copyright" content="Driving Skills For Life" />
	<title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
    <link href="/?format=feed&amp;type=rss" rel="alternate" type="application/rss+xml" title="RSS 2.0" />
    <link href="/?format=feed&amp;type=atom" rel="alternate" type="application/atom+xml" title="Atom 1.0" />
    <link href="<?=$template_url;?>/images/wst-logo.svg"
          rel="shortcut icon" type="image/vnd.microsoft.icon" />
    <link href="<?=$template_url;?>assets/css/main.css?v=1" rel="stylesheet"/>
    <script src="<?=$template_url;?>assets/js/main.js?v=1"></script>
</head>
<body>
    <footer>
        <div class="container">
            <div class="logos">
                <div class="footer-logo driving-logo">
                    <a class="link v-align" href="/">
                        <img class="" src="/images/_default/logo-large.png"/>
                    </a>
                </div>
                <div class="footer-logo pull-right">
                    <a class="link v-align" href="/" target="_blank">
                        <img class="" src="/templates/dsfl/assets/img/logos/logo_ford-v2.png" style="max-height:37px;">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
