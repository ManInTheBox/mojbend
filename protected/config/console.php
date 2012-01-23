<?php

Yii::setPathOfAlias('wrappers', dirname(__FILE__) . '/components/wrappers');

return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Moj Bend Console',
    'import' => array(
        'application.models.*',
        'application.components.*',
        'application.components.wrappers.*',
        'application.validators.*',
    ),
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=mojbend_dev',
            'emulatePrepare' => true,
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ),
    ),
    'commandMap' => array(
        'migrate' => array(
            'class' => 'system.cli.commands.MigrateCommand',
            'templateFile' => 'application.migrations._template',
        ),
        'message' => 'application.commands.MyMessageCommand',
    ),
);