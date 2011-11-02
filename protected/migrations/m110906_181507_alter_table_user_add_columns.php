<?php

class m110906_181507_alter_table_user_add_columns extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('user', 'email', 'string NOT NULL UNIQUE');
        $this->addColumn('user', 'first_name', 'varchar(64)');
        $this->addColumn('user', 'last_name', 'varchar(64)');
        $this->addColumn('user', 'full_name', 'varchar(129)');
        $this->addColumn('user', 'create_time', 'int(13) unsigned');
    }

    public function safeDown()
    {
    }
}