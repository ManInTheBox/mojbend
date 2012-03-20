<?php

return array(
    'prijavljivanje' => 'user/login',
    'registracija' => 'user/register',
    'odjavljivanje' => 'user/logout',
    
    '<alias:\w+>' => 'user/home',
    'home/<alias:\w+>' => 'user/home',
    'home/<uid:\d+>' => 'user/home',
    'home' => 'user/home',
    
    'nova-lozinka' => 'user/passwordReset',
    'izgubljena-lozinka' => 'user/lostPassword',
    
    '' => 'site/index',

//                '<action:\w+>' => 'site/<action>',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

);