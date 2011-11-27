<?php

class m111127_203623_create_table_user_log extends CDbMigration
{
    public function safeUp()
    {
        $this->createTable('user_log', array(
            'id' => 'pk',
            'user_id' => 'integer NOT NULL',
            'created_at' => 'INT UNSIGNED NOT NULL',
            'ip_address' => 'INT UNSIGNED',
            'user_agent' => 'string',
        ), 'ENGINE = InnoDB');
        
        $this->createIndex('user_id_idx', 'user_log', 'user_id');
        $this->addForeignKey('fk_user_log_user', 'user_log', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        
    }

    public function safeDown()
    {
    }
}