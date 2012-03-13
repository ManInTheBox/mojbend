<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />

        <!-- blueprint CSS framework -->
<!--        <link rel="stylesheet" type="text/css" href="<?php echo bu(); ?>/css/screen.css" media="screen, projection" />
        <link rel="stylesheet" type="text/css" href="<?php echo bu(); ?>/css/print.css" media="print" />-->
        <!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo bu(); ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

<!--        <link rel="stylesheet" type="text/css" href="<?php echo bu(); ?>/css/main.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo bu(); ?>/css/form.css" />-->

        <link rel="stylesheet" type="text/css" href="<?php echo bu(); ?>/css/style.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>


        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    </head>

    <body>

        <div id="wrapper">
            <div id="header-wrapper">
                <div id="header">
                    <div id="logo">
                        <h1><a href="<?php echo bu(); ?>">Mojbend.com</a></h1>
                        <p>sva ta muzika...</p>
                    </div>
                    <div id="menu">

                        <?php
                        $this->widget('zii.widgets.CMenu', array(
                            'activeCssClass' => 'current_page_item',
                            'items' => array(
                                array('label' => 'Pocetna', 'url' => array('/site/index')),
                                array('label' => 'About', 'url' => array('/site/page', 'view' => 'about')),
                                array('label' => 'Contact', 'url' => array('/site/contact')),
                                array('label' => 'Login', 'url' => array('/user/login'), 'visible' => Yii::app()->user->isGuest),
                                array('label' => 'Logout (' . u()->name . ')', 'url' => array('/user/logout'), 'visible' => !guest())
                            ),
                        ));
                        ?>
                    </div>
                </div>
            </div>
            <!-- end #header -->
            <div id="page">
                <div id="page-bgtop">
                    <div id="page-bgbtm">
                        <div id="content">
                            <?php echo $content; ?>
                        </div>
                        <?php echo $this->renderPartial($this->sidebar); ?>
                        <div style="clear: both;">&nbsp;</div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <p>mojbend.com</p>
            </div>
        </div>
    </body>
</html>