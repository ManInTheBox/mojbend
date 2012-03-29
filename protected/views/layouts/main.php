<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo e($this->pageTitle); ?></title>
        <link rel="stylesheet" href="<?php echo bu(); ?>/css/styles.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo bu(); ?>/css/jquery-ui.css" type="text/css" />
        <link rel="stylesheet" href="<?php echo bu(); ?>/js/fancybox/jquery.fancybox.css" type="text/css" />
        <script type="text/javascript" src="<?php echo bu(); ?>/js/jquery.js"></script>
        <script type="text/javascript" src="<?php echo bu(); ?>/js/jquery.mousewheel.js"></script>
        <script type="text/javascript" src="<?php echo bu(); ?>/js/jquery-ui.js"></script>
        <script type="text/javascript" src="<?php echo bu(); ?>/js/slider.js"></script>
        <script type="text/javascript" src="<?php echo bu(); ?>/js/superfish.js"></script>
        <script type="text/javascript" src="<?php echo bu(); ?>/js/custom.js"></script>
        <script type="text/javascript" src="<?php echo bu(); ?>/js/fancybox/jquery.fancybox.pack.js"></script>

        <link rel="stylesheet" href="<?php echo bu(); ?>/js/fancybox/helpers/jquery.fancybox-buttons.css?v=2.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo bu(); ?>/js/fancybox/helpers/jquery.fancybox-buttons.js?v=2.0.5"></script>

        <link rel="stylesheet" href="<?php echo bu(); ?>/js/fancybox/helpers/jquery.fancybox-thumbs.css?v=2.0.5" type="text/css" media="screen" />
        <script type="text/javascript" src="<?php echo bu(); ?>/js/fancybox/helpers/jquery.fancybox-thumbs.js?v=2.0.5"></script>

    </head>
    <body class="<?php echo $this->bodyClass; ?>">
        <div id="container">
            <div id="header">
                <h1><a href="<?php echo guest() ? bu() : u()->homeUrl; ?>">moj<strong>bend</strong></a></h1>
                <h2><?php echo t('ovde je muzika...'); ?></h2>
                <div class="clear"></div>
            </div>
            <div id="nav">
                <?php
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions' => array(
                        'class' => 'sf-menu dropdown',
                    ),
                    'activeCssClass' => 'selected',
                    'items' => array(
                        array('label' => t('Početna'), 'url' => guest() ? array('/site/index') : u()->homeUrl),
                        array('label' => t('Bendovi'), 'url' => array('/group/list'), 'linkOptions' => array('class' => 'has_submenu'), 'items' => array(
                            array('label' => t('Moji bendovi'), 'url' => array('/group/mine'), 'visible' => !guest()),
                            array('label' => t('Najpopularniji'), 'url' => array('/group/popular')),
                            array('label' => t('Najnoviji'), 'url' => array('/group/newest'))
                        )),
                        array('label' => t('Muzičari'), 'url' => array('/artist/list'), 'linkOptions' => array('class' => 'has_submenu'), 'items' => array(
                            array('label' => t('Najpopularniji'), 'url' => array('/artist/popular')),
                            array('label' => t('Najnoviji'), 'url' => array('/artist/newest'))
                        )),
                        array('label' => t('Nalog'), 'url' => array('/user/edit'), 'visible' => !guest()),
                        array('label' => t('Uloguj se'), 'url' => array('/user/login'), 'visible' => guest()),
                        array('label' => t('Izloguj se'), 'url' => array('/user/logout'), 'visible' => !guest()),
                        array('label' => t('Registruj se'), 'url' => array('/user/register'), 'visible' => guest())
                    ),
                ));
                ?>
            </div>
            <?php
                if ($this->bodyClass == 'homepage')
                {
                    $this->renderPartial('//layouts/_slides', $this->slidesData);
                }
            ?>
            <div id="body">
                <div id="content">
                    <?php echo $content; ?>
                </div>
                <div class="sidebar">
                    <?php $this->renderPartial($this->sidebar, $this->sidebarData); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="footer">
            <?php $this->renderPartial($this->footer); ?>
        </div>
    </body>
</html>
