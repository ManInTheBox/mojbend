<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property integer $id
 * @property string $path
 * @property string $created_at
 */
class Picture extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Picture the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'picture';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('path', 'required'),
            array('path', 'length', 'max'=>32),
            array('created_at', 'length', 'max'=>10),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => t('ID'),
            'path' => t('Path'),
            'created_at' => t('Created At'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        $this->store();
        return parent::beforeSave();
    }

    public function store()
    {
        $this->path = Utility::generateHash();
        $path = path('webroot.images');
        
        $levelOne = substr($this->path, 0, 2);
        $levelTwo = substr($this->path, 2, 2);
        $levelThree = substr($this->path, 4, 2);

        $fileName = substr($this->path, 6);
        
        mkdir("$path/$levelOne/$levelTwo/$levelThree", 0777, true);
    }
}