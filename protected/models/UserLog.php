<?php

/**
 * This is the model class for table "user_log".
 *
 * The followings are the available columns in table 'user_log':
 * @property integer $id
 * @property integer $user_id
 * @property string $created_at
 * @property string $ip_address
 * @property string $user_agent
 *
 * @property User $user
 */
class UserLog extends ActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return UserLog the static model class
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
        return 'user_log';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id, created_at', 'required'),
            array('user_id', 'numerical', 'integerOnly' => true),
            array('created_at, ip_address', 'length', 'max' => 10),
            array('user_agent', 'length', 'max' => 255),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
        );
    }

    public function behaviors()
    {
        return array(
            'CTimestampBehavior' => array(
                'class' => 'zii.behaviors.CTimestampBehavior',
                'createAttribute' => 'created_at',
            )
        );
    }
    
    protected function beforeSave()
    {
        $this->ip_address = sprintf("%u", ip2long(r()->userHostAddress));
        $this->user_agent = r()->userAgent;
        return parent::beforeSave();
    }

}