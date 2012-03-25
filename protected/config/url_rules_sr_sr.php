<?php

return array(
    'пријављивање' => 'user/login',
    'регистрација' => 'user/register',
    'одјављивање' => 'user/logout',
    
    '<alias:\w+>' => 'user/home',
    'почетна/<alias:\w+>' => 'user/home',
    'home/<uid:\d+>' => 'user/home',
    'home' => 'user/home',
    
    'нова-лозинка' => 'user/passwordReset',
    'изгубљена-лозинка' => 'user/lostPassword',
    
    '' => 'site/index',

//                '<action:\w+>' => 'site/<action>',
//                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
//                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',

);