<?php

function e($string)
{
    return htmlspecialchars($string, ENT_QUOTES, Yii::app()->charset);
}

function a()
{
    return Yii::app();
}

function u()
{
    return Yii::app()->getUser();
}

function r()
{
    return Yii::app()->getRequest();
}

function db()
{
    return Yii::app()->getDb();
}

function l($text, $url, $htmlOptions = array())
{
    return CHtml::link($text, $url, $htmlOptions);
}

function url($route, $params = array(), $ampersand = '&')
{
    return Yii::app()->getController()->createUrl($route, $params, $ampersand);
}

function t($message, $category = 'mojbend', $params = array(), $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}