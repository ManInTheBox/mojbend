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

}