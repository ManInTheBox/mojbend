<?php

/**
 * Wrapper of {@link CActiveRecord}
 * Contains custom specific logic common to all child classes
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class ActiveRecord extends CActiveRecord
{
    private $_unpackedDates;
    
    public $emptyMessage;
    
    public function init()
    {
        $this->emptyMessage = t('Nema informacija.');
        $this->clearDate();
    }
        
    protected function afterFind()
    {
        $this->unpackDate();
        parent::afterFind();
    }
    
    protected function beforeSave()
    {
        $this->packDate();
        return parent::beforeSave();
    }
    
    protected function afterSave()
    {
        $this->unpackDate();
        parent::afterSave();
    }
    
    public function unpackDate()
    {
        foreach ($this->metaData->columns as $column)
        {
            if ($column->dbType == 'date')
            {
                if ($this->{$column->name})
                {
                    $this->_unpackedDates[] = $column->name;
                    $d = explode('-', $this->{$column->name});
                    $date = "$d[2].$d[1].$d[0]";
                    $this->{$column->name} = $date;
                }
            }
        }
    }
    
    public function packDate()
    {
        if ($this->_unpackedDates)
        {
            foreach ($this->_unpackedDates as $unpackedDate)
            {
                if ($this->$unpackedDate)
                {
                    $d = explode('.', $this->$unpackedDate);
                    $date = "$d[2]-$d[1]-$d[0]";
                    $this->$unpackedDate = $date;
                }
            }
        }
    }
    
    public function clearDate()
    {
        foreach ($this->metaData->columns as $column)
        {
            if ($column->dbType == 'date')
            {
                $this->{$column->name} = null;
            }
        }
    }
    
    public function displayDate()
    {
        if ($this->_unpackedDates)
        {
            foreach ($this->_unpackedDates as $unpackedDate)
            {
                if ($this->$unpackedDate === '00.00.0000')
                {
                    $this->$unpackedDate = $this->emptyMessage;
                }
            }
        }
    }

    public function getUrl()
    {
    }
}