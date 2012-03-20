<?php

return array(
    'login' => 'user/login',
    'register' => 'user/register',
    'logout' => 'user/logout',
    
    '<alias:\w+>' => 'user/home',
    'home/<alias:\w+>' => 'user/home',
    'home/<uid:\d+>' => 'user/home',
    'home' => 'user/home',
    
    'new-password' => 'user/passwordReset',
    'lost-password' => 'user/lostPassword',
    
    '' => 'site/index',

//                '<action:\w+>' => 'site/<action>',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

);