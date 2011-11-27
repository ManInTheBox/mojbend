<?php

return array(
    'sourcePath' => dirname(__FILE__) . '/../../',
    'messagePath' => dirname(__FILE__),
    'languages' => array('sr_sr',),
    'fileType' => array('php'),
    'translator' => 't',
    'exclude' => array(
        '.git',
        '/webroot/index.php',
        '/webroot/yiic.php',
        '/webroot/assets',
        '/webroot/css',
        '/webroot/images',
        '/webroot/theme',
        '/protected/gii',
        '/protected/tests',
        '/protected/migrations',
        '/protected/data',
        '/runtime',
    ),
);