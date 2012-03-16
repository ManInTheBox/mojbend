<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $salt
 * @property integer $status
 * @property string $created_at
 * @property string $language
 * @property string $cookie_token
 * @property integer $logged_in
 * @property string $activation_hash
 * @property string $username
 */
class User extends ActiveRecord
{
    const STATUS_INACTIVE = 0;
    const STATUS_PENDING = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_SUSPENDED = 3;
    const STATUS_DEACTIVATED = 4;
    
    const LOGGED_IN = 1;
    const LOGGED_OUT = 0;

    public $is_artist = false;

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
            array('email, password', 'required'),
            array('status, logged_in', 'numerical', 'integerOnly' => true),
            array('email', 'length', 'max' => 255),
            array('email', 'email',),
            array('email', 'unique'),
//            array('email', 'email', 'checkMX' => true),
            array('password', 'length', 'max' => 128),
            array('salt, cookie_token', 'length', 'max' => 32),
            array('created_at, language', 'length', 'max' => 10),
            array('is_artist', 'boolean'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'person' => array(self::HAS_ONE, 'Person', 'user_id'),
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'email' => t('Email'),
            'password' => t('Password'),
            'language' => t('Language'),
            'is_artist' => t('Da li ste muzicar?'),
//            'is_artist' => t('Are you artist?'),
        );
    }
    
    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {
            $this->created_at = time();
            $this->salt = Utility::generateHash();
            $this->password = self::encryptPassword($this->password, $this->salt);
            $this->activation_hash = Utility::generateHash();
        }
        
        return parent::beforeSave();
    }

    public static function encryptPassword($value, $secret)
    {
        return hash_hmac('md5', $value, $secret);
    }

    public function getHomeUrl($absolute = false)
    {
        $homeUrl = '';
        
        if ($this->username)
        {
            $homeUrl = url('/user/home', array('alias' => $this->username), $absolute);
        }
        else
        {
            $homeUrl = url('/user/home', array('uid' => $this->id), $absolute);
        }

        return $homeUrl;
    }

}