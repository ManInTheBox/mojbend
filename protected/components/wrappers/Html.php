<?php

/**
 * Description of Html
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class Html extends CHtml
{
    public static function getListOptions($table)
    {
        $query = "SELECT * FROM $table;";
        $options = sql($query)->queryAll();

        $result = array();
        foreach ($options as $option)
        {
            $result[$option['id']] = $option['name'];
        }
        return $result;
    }
}