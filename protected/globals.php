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

function c()
{
    return Yii::app()->getController();
}

function db()
{
    return Yii::app()->getDb();
}

function l($text, $url = '#', $htmlOptions = array())
{
    return CHtml::link($text, $url, $htmlOptions);
}

function url($route, $params = array(), $absolute = false, $ampersand = '&', $schema = '')
{
    $url = '';
    if ($absolute)
    {
        $url = Yii::app()->getController()->createAbsoluteUrl($route, $params, $schema, $ampersand);
    }
    else
    {
        $url = Yii::app()->getController()->createUrl($route, $params, $ampersand);
    }
    return $url;
}

function t($message, $params = array(), $category = 'mojbend', $source = null, $language = null)
{
    return Yii::t($category, $message, $params, $source, $language);
}

function bu($absolute = false)
{
    return Yii::app()->getBaseUrl($absolute);
}

function sql($query = null)
{
    return Yii::app()->getDb()->createCommand($query);
}

function ajax()
{
    return Yii::app()->getRequest()->getIsAjaxRequest();
}

function post()
{
    return Yii::app()->getRequest()->getIsPostRequest();
}

function guest()
{
    return Yii::app()->getUser()->getIsGuest();
}

function path($alias)
{
    return Yii::getPathOfAlias($alias);
}

function mb_ucfirst($string, $encoding = 'UTF-8')
{
    $string = trim($string);
    $strlen = mb_strlen($string, $encoding);
    $firstChar = mb_substr($string, 0, 1, $encoding);
    $then = mb_substr($string, 1, $strlen - 1, $encoding);
    
    return mb_strtoupper($firstChar, $encoding) . $then;
}

function mb_ucwords($string, $encoding = 'UTF-8')
{
    $result = '';
    $string = trim($string);
    $words = explode(' ', $string);
    foreach ($words as $word)
    {
        $result .= mb_ucfirst($word, $encoding) . ' ';
    }
    
    return $result;
}