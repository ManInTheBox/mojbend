<?php

/**
 * This is the model class for table "fan_group".
 *
 * The followings are the available columns in table 'fan_group':
 * @property integer $fan_id
 * @property integer $group_id
 * @property string $created_at
 *
 * @property User $fan
 * @property Group $group
 */
class FanGroup extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return FanGroup the static model class
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
        return 'fan_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('fan_id, group_id, created_at', 'required'),
            array('fan_id, group_id', 'numerical', 'integerOnly'=>true),
            array('created_at', 'length', 'max'=>10),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'fan' => array(self::BELONGS_TO, 'User', 'fan_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        return parent::beforeSave();
    }
}