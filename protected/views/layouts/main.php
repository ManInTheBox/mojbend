<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $this->pageTitle; ?></title>
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
    <body class="homepage">
        <div id="container">
            <div id="header">
                <h1><a href="<?php echo bu(); ?>">moj<strong>bend</strong></a></h1>
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
                        array('label' => t('Početna'), 'url' => array('/site/index')),
                        array('label' => t('Bendovi'), 'url' => array('/group/list'), 'linkOptions' => array('class' => 'has_submenu'), 'items' => array(
                            array('label' => t('Moji bendovi'), 'url' => array('/group/mine'), 'visible' => !guest()),
                            array('label' => t('Najpopularniji'), 'url' => array('/group/popular')),
                            array('label' => t('Najnoviji'), 'url' => array('/group/newest'))
                        )),
                        array('label' => t('Muzičari'), 'url' => array('/artist/list'), 'linkOptions' => array('class' => 'has_submenu'), 'items' => array(
                            array('label' => t('Najpopularniji'), 'url' => array('/artist/popular')),
                            array('label' => t('Najnoviji'), 'url' => array('/artist/newest'))
                        )),
                        array('label' => t('Uloguj se'), 'url' => array('/user/login'), 'visible' => guest()),
                        array('label' => t('Izloguj se'), 'url' => array('/user/logout'), 'visible' => !guest()),
                        array('label' => t('Registruj se'), 'url' => array('/user/register'), 'visible' => guest())
                    ),
                ));
                ?>
            </div>
            <div id="slides-container" class="slides-container">
                <div id="slides">
                    <div>
                        <div class="slide-image"><img src="<?php echo bu(); ?>/images/slide-1.png" alt="Slide #1 image" /></div>
                        <div class="slide-text">
                            <h2>Slide #1</h2>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque venenatis sagittis enim. Maecenas ligula erat, egestas congue, varius nec, sagittis nec, purus. In neque.</p>
                            <p class="frontpage-button">
                                <a href="#">Lorem ipsum dolor</a>
                            </p>
                        </div>
                    </div>

                    <div>
                        <h2>Have fun with slides!</h2>
                        <p>These slides can contain anything a webpage can!HTML, Javascript, images, flash or whatever!They're completely easy to edit and add to as well, no need to bother editing or even going anywhere near some confusing Javascript files, simply add a &lt;div&gt;&lt;/div&gt; tag with your slider content to the "slides" contain - it takes just seconds to do!</p>
                        <p>These slides work using the absolutely wonderful lightweight jQuery plugin <a href="http://plugins.jquery.com/project/jFlow">jFlow</a>, originally written by Kean Loong and modified by both Mauro Belgiovine and spyka Webmaster. The script has been licensed under the open source MIT license, so feel free to play around and modify it as much or as little as you wish!</p>
                    </div>

                    <div>
                        <div class="slide-image slide-image-right"><img src="<?php echo bu(); ?>/images/slide-3.png" alt="Slide #3 image" /></div>
                        <div class="slide-text">
                            <h2>Slide #3</h2>
                            <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Pellentesque venenatis sagittis enim. Maecenas ligula erat, egestas congue, varius nec, sagittis nec, purus. In neque. Curabitur at metus tincidunt dui tristique molestie. Donec porta molestie tortor. Fusce euismod consectetuer sapien. Fusce ac velit.</p>
                        </div>
                    </div>
                </div>
                <div class="controls"><span class="jFlowNext"><span>Next</span></span><span class="jFlowPrev"><span>Prev</span></span></div>
                <div id="myController" class="hidden"><span class="jFlowControl">Slide 1</span><span class="jFlowControl">Slide 1</span><span class="jFlowControl">Slide 1</span></div>
            </div>

            <div id="body">
                <div id="content">
                    <?php echo $content; ?>
                    <!--                    <div class="box">
                                            <h2>Introduction</h2>
                                            <p>Welcome to widget, a free premium valid CSS &amp; XHTML strict web template from <a href="http://www.spyka.net" title="spyka webmaster">spyka Webmaster</a>. This template is completely <strong>free</strong> to use permitting a link remains back to  <a href="http://www.spyka.net" title="spyka webmaster">http://www.spyka.net</a>. Should you wish to use this template unbranded you can buy a template license from our website for 8.00 GBP, this will allow you remove all branding related to our site, for more information about this see below.</p>

                                            <p>This template has been tested in:</p>

                                            <ul class="styledlist">
                                                <li>Firefox 3.5</li>
                                                <li>Opera 10.00</li>
                                                <li>IE 6, 7 and 8</li>
                                                <li>Chrome</li>
                                            </ul>

                                            <h3>Buy unbranded</h3>


                                            <p>Purchasing a template license for 8.00 GBP (at time of writing around 12 USD) gives you the right to remove any branding including links, logos and source tags relating to spyka webmaster. As well as waiving the attribution requirement, your payment will also help us provide continued support for users as well as creating new web templates. Find out more about how to buy at the licensing page on our website which can be accessed at <a href="http://www.spyka.net/licensing" title="template license">http://www.spyka.net/licensing</a></p>

                                            <h3>More free web templates</h3>
                                            <p>Looking for more free web templates for other projects? Check out our <a href="http://justfreetemplates.com/portfolio?user=spyka">free web template portfolio</a>. We also offer <a href="http://www.spyka.net/wordpress-themes">WordPress themes</a> and <a href="http://www.awesomestyles.com">phpBB3 styles</a>, all of which are released under Open Source or Creative Commons licenses!</p>


                                            <h3>Webmaster forums</h3>
                                            <p>You can get help with editing and using this template, as well as design tips, tricks and advice in our <a href="http://www.spyka.net/forums" title="webmaster forums">webmaster forums</a></p>
                                        </div>-->
                </div>
                <div class="sidebar">
                    <?php $this->renderPartial($this->sidebar); ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="footer">
            <?php $this->renderPartial($this->footer); ?>
        </div>
    </body>
</html>
