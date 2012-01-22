<?php

Yii::setPathOfAlias('wrappers', dirname(__FILE__) . '/components/wrappers');

return array(
    'sourceLanguage' => 'en',
    'basePath' => dirname(__FILE__) . '/..',
    'onBeginRequest' => array('Bootstrap', 'beginRequest'),
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
            'class' => 'application.components.wrappers.WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/user/login'),
        ),
        'request' => array(
            'enableCsrfValidation' => true,
            'csrfTokenName' => 'CSRF_TOKEN',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => require_once dirname(__FILE__) . '/url_rules.php',
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
            'class' => 'application.components.wrappers.ErrorHandler',
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