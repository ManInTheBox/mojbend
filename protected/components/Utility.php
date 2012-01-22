<?php

/**
 * Description of Utility
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class Utility
{

    public static function generateHash()
    {
        $chars = str_split('~#$`:"&*();<>?,.+=[]{}-!@\/%^_|\'');
        $keys = array_rand($chars, 8);
        foreach ($keys as $key)
        {
            $salt[] = $chars[$key];
        }
        $salt = implode('', $salt);
        return md5($salt . microtime());
    }

    public static function splitByCaps($string)
    {
        return preg_replace('/([a-z0-9]){1}([A-Z])/', '$1 $2', $string);
    }

}