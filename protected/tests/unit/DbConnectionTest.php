<?php

/**
 * Description of DbConnectionTest
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class DbConnectionTest extends CDbTestCase
{
    public function testConnection()
    {
        $this->assertNotNull(Yii::app()->db, "\n-------------------------\nInvalid DB connection...\n-------------------------\n");
    }
}