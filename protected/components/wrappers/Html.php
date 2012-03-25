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

    public static function getChosenListOption($id, $table)
    {
        $query = "SELECT name FROM `$table` WHERE id = :id";
        $params = array(':id' => $id);
        return sql($query)->queryScalar($params);
    }

}