<?php

class m120320_024552_insert_into_artist_type_instrument extends CDbMigration
{
    public function safeUp()
    {
        $sql = "
            INSERT INTO `list_instrument` (`id`, `name`, `description`) VALUES
(1, 'Guitar', 'This is very good instrument...'),
(2, 'Violin', NULL),
(3, 'Bass guitar', NULL),
(4, 'Drums', NULL),
(5, 'Piano', NULL),
(6, 'Trombone', NULL),
(7, 'Keyboard', NULL),
(8, 'Vocals', NULL),
(9, 'Back vocals', NULL);

INSERT INTO `list_artist_type` (`id`, `name`) VALUES
(1, 'Guitarist'),
(2, 'Drummer'),
(3, 'Bas gitarista'),
(4, 'Glavni vokal'),
(5, 'Klavijaturista'),
(6, 'Prateći vokal'),
(7, 'Solo pevač');
";
        $this->execute($sql);
    }

    public function safeDown()
    {
    }
}