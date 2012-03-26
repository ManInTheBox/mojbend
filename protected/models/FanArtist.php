<?php

/**
 * This is the model class for table "fan_artist".
 *
 * The followings are the available columns in table 'fan_artist':
 * @property integer $fan_id
 * @property integer $artist_id
 * @property string $created_at
 */
class FanArtist extends ActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return FanArtist the static model class
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
        return 'fan_artist';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('fan_id, artist_id', 'required'),
            array('fan_id, artist_id', 'numerical', 'integerOnly' => true),
            array('created_at', 'length', 'max' => 10),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'fan' => array(self::BELONGS_TO, 'User', 'fan_id'),
            'artist' => array(self::BELONGS_TO, 'Artist', 'artist_id'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        return parent::beforeSave();
    }

}