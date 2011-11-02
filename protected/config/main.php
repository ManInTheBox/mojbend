<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'sourceLanguage' => 'en_us',
//    'language' => 'sr_sr',
    'basePath' => dirname(__FILE__) . '/..',
    'runtimePath' => dirname(__FILE__) . '/../../runtime',
    'name' => 'Moj Bend',
    // preloading 'log' component
    'preload' => array('log'),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
        'ext.giix-components.*',
    ),
    'modules' => array(
        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => '123123',
            'ipFilters' => array('127.0.0.1', '::1', '192.168.0.3',),
            'generatorPaths' => array(
                'application.gii',
                'ext.giix-core',
                'ext.gtc',
            ),
        ),
        'webshell' => array(
            'class'=>'ext.yiiext.modules.webshell.WebShellModule',
            'ipFilters' => array('127.0.0.1', '::1', '192.168.0.3',),
            'exitUrl' => '/',
            // custom wterm options
            'wtermOptions' => array(
                // linux-like command prompt
                'PS1' => 'zarko@zare:~$',
            ),
            'commands' => array(
                // js callback as a command
                'test' => array('js:function(tokens){return "Hello, world!";}', 'Just a test.'),

                // ajax callback to http://yourwebsite/post/index?action=cli (will be normalized according to URL rules)
                'postlist' => array(array('/post/index', array('action' => 'cli')), 'Description.'),

                // sticky command handler. One will need to type 'exit' to leave its context.
                'stickyhandler' => array(
                    array(
                        // optional: called when 'stickyhandler' is typed. Can be either URL array or callback.
                        'START_HOOK' => array('/post/index', array('action' => 'start')),
                        // optional: called when 'exit' is typed. Can be either URL array or callback.
                        'EXIT_HOOK' => "js:function(){ return 'bye!'; }",
                        // required: called when parameter is typed. Can be either URL array or callback.
                        'DISPATCH' => "js:function(tokens){ return \"Hi, Jack!\"; }",
                        // optional: custom prompt
                        'PS1' => 'advanced >',
                    ),
                    'Advanced command.',
                ),
            ), 
            
            // uncomment to disable yiic
             'useYiic' => true, 
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            'class' => 'application.components.WebUser',
            'allowAutoLogin' => true,
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => array(
                // start webshell
                'webshell'=>'webshell',
                'webshell/<controller:\w+>'=>'webshell/<controller>',
                'webshell/<controller:\w+>/<action:\w+>'=>'webshell/<controller>/<action>',
                // end webshell
                '' => 'site/index',
                '<action:\w+>' => 'site/<action>',
                '<controller:\w+>/<action:\w+>/*' => '<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
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
            // use 'site/error' action to display errors
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
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ),
);