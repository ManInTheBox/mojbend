<?php

/**
 * This is the model class for table "picture".
 *
 * The followings are the available columns in table 'picture':
 * @property integer $id
 * @property string $name
 * @property string $path
 * @property string $created_at
 * @property integer $size
 * @property string $type
 * @property string $extension
 */
class Picture extends ActiveRecord
{
    const DEFAULT_ID = 1;

    public $storePath;

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
            array('name', 'required'),
            array('path', 'length', 'max'=>3200),
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
        return parent::beforeSave();
    }

    public function prepare()
    {
        $this->path = Utility::generateHash();
        
        $levelOne = substr($this->path, 0, 2);
        $levelTwo = substr($this->path, 2, 2);
        $levelThree = substr($this->path, 4, 2);

        $this->name = substr($this->path, 6);
        $this->path = "$levelOne/$levelTwo/$levelThree/{$this->name}.{$this->extension}";

        $this->storePath = path('webroot.images') . "/$levelOne/$levelTwo/$levelThree";
        mkdir($this->storePath, 0777, true);

        return $this;
    }

    public static function getDefault()
    {
        return self::model()->findByPk(self::DEFAULT_ID);
    }

    public function getRealPath()
    {
        return path('webroot.images') . '/' . $this->path;
    }

    public function generateThumbs()
    {
        $imageProcessor = new ImageProcessor($this->realPath);
        $imageProcessor->resize(351, 216);
        $imageProcessor->save($this->storePath . '/' . $this->name . '_front.' . $this->extension);
        $imageProcessor->resize(351, 216);
        $imageProcessor->save($this->storePath . '/' . $this->name . '_small.' . $this->extension);
        $imageProcessor->resize(351, 216);
        $imageProcessor->save($this->storePath . '/' . $this->name . '_large.' . $this->extension);
        $imageProcessor->resize(351, 216);
        $imageProcessor->save($this->realPath); // profile
    }

    public function getShortPath()
    {
        return bu() . '/images/' . $this->path;
    }

}