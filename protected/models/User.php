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
 * 
 * @property Artist $artist
 * @property Artist[] $artists
 * @property Group[] $groups
 * @property InternalErrorLog[] $internalErrorLogs
 * @property Person $person
 * @property UserLog[] $userLogs
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

    private $_isArtist = false;

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
            array('email', 'unique'),
            array('email', 'email', 'checkMX' => true),
            array('password', 'length', 'max' => 32),
            array('salt, cookie_token', 'length', 'max' => 32),
            array('created_at, language', 'length', 'max' => 10),
            array('isArtist', 'boolean'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'artist' => array(self::HAS_ONE, 'Artist', 'user_id'),
            'artists' => array(self::MANY_MANY, 'Artist', 'fan_artist(fan_id, artist_id)'),
            'groups' => array(self::MANY_MANY, 'Group', 'fan_group(fan_id, group_id)'),
            'internalErrorLogs' => array(self::HAS_MANY, 'InternalErrorLog', 'user_id'),
            'person' => array(self::HAS_ONE, 'Person', 'user_id'),
            'userLogs' => array(self::HAS_MANY, 'UserLog', 'user_id'),
            'profilePicture' => array(self::BELONGS_TO, 'Picture', 'profile_picture_id'),
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'email' => t('E-mail'),
            'password' => t('Lozinka'),
            'language' => t('Jezik'),
            'isArtist' => t('Da li ste muzičar?'),
            'username' => t('Korisničko ime'),
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
//        $homeUrl = '';
        
//        if ($this->username)
//        {
//            $homeUrl = url('/user/home', array('alias' => $this->username), $absolute);
//        }
//        else
//        {
//            $homeUrl = url('/user/home', array('uid' => $this->id), $absolute);
//        }

//        return $homeUrl;

        return $this->isArtist ? $this->artist->url : $this->url;

    }
    
    public function getIsArtist()
    {
        return $this->_isArtist || isset ($this->artist);
    }
    
    public function setIsArtist($value)
    {
        $this->_isArtist = $value;
    }

    public function getUrl()
    {
        return url('/user/view', array('uid' => $this->id));
    }
}