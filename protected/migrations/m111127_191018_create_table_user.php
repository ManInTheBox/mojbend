<?php

class m111127_191018_create_table_user extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('user', array(
            'id' => 'pk',
            'email' => 'string NOT NULL',
            'password' => 'VARCHAR(128) NOT NULL',
            'salt' => 'VARCHAR(32) NOT NULL',
            'status' => 'TINYINT NOT NULL',
            'created_at' => 'INT UNSIGNED NOT NULL',
            'language' => 'VARCHAR(10)',
            'cookie_token' => 'VARCHAR(32)',
            'logged_in' => 'TINYINT DEFAULT 0',
        ), 'ENGINE = InnoDB');
    }

    public function safeDown()
    {
    }
}