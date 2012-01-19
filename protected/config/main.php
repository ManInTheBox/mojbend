<?php

Yii::setPathOfAlias('wrappers', dirname(__FILE__) . '/components/wrappers');

return array(
//    'sourceLanguage' => 'sr_sr',
    'basePath' => dirname(__FILE__) . '/..',
    'runtimePath' => dirname(__FILE__) . '/../../runtime',
    'homeUrl' => array('/site/index'),
    'name' => 'Moj Bend',
    'preload' => array('log'),
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.wrappers.*',
        'application.validators.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123',
            'ipFilters' => array('127.0.0.1', '::1', '192.168.0.3',),
            'generatorPaths' => array(
                'application.gii',
            ),
        ),
    ),
    'components' => array(
        'user' => array(
            'class' => 'application.components.WebUser',
            'allowAutoLogin' => true,
        ),
        'request' => array(
            'enableCsrfValidation' => true,
            'csrfTokenName' => 'CSRF_TOKEN',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                '' => 'site/index',
                'home' => 'user/index',
                '<action:\w+>' => 'site/<action>',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=mojbend_dev',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling' => true,
            'enableParamLogging' => true,
        ),
        'errorHandler' => array(
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
                array(
                    'class' => 'CWebLogRoute',
                    'filter' => 'CLogFilter',
                ),
                array(
                    'class' => 'CProfileLogRoute',
                    'report' => 'callstack',
                ),
            ),
        ),
    ),
);