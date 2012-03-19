<?php

/**
 * Wrapper of {@link CActiveRecord}
 * Contains custom specific logic common to all child classes
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class ActiveRecord extends CActiveRecord
{
    public $emptyMessage;

    public function __construct($scenario = 'insert')
    {
        $this->emptyMessage = t('Nema informacija.');
        parent::__construct($scenario);
    }
}