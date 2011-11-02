<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $full_name
 * @property string $create_time
 */
class User extends ActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return User the static model class
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
        return 'user';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('username, password, email', 'required'),
            array('username, first_name, last_name', 'length', 'max' => 64),
            array('password', 'length', 'max' => 128),
            array('email', 'length', 'max' => 255),
            array('full_name', 'length', 'max' => 129),
            array('create_time', 'length', 'max' => 13),
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
            'id' => Yii::t('mojbend', 'ID'),
            'username' => Yii::t('mojbend', 'Username'),
            'password' => Yii::t('mojbend', 'Password'),
            'email' => Yii::t('mojbend', 'Email'),
            'first_name' => Yii::t('mojbend', 'First Name'),
            'last_name' => Yii::t('mojbend', 'Last Name'),
            'full_name' => Yii::t('mojbend', 'Full Name'),
            'create_time' => Yii::t('mojbend', 'Create Time'),
        );
    }

    /**
     * Encrypts password using md5 algorithm
     * 
     * @return string md5 password value 
     */
    public static function encryptPassword($valueToEncrypt)
    {
        return md5($valueToEncrypt);
    }

    /**
     * Some tunes like uppercase first character of first and last name
     * and concatenate them into full name
     */
    protected function afterValidate()
    {
        $this->first_name = ucfirst($this->first_name);
        $this->last_name = ucfirst($this->last_name);

        $this->full_name = $this->first_name . ' ' . $this->last_name;

        parent::afterValidate();
    }

}