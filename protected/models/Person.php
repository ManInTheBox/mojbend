<?php

/**
 * This is the model class for table "person".
 *
 * The followings are the available columns in table 'person':
 * @property integer $user_id
 * @property string $first_name
 * @property string $last_name
 * @property integer $gender
 * @property string $birth_date
 *
 * @property User $user
 */
class Person extends ActiveRecord
{

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

    /**
     * Returns the static model of the specified AR class.
     * @return Person the static model class
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
        return 'person';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id', 'required'),
            array('user_id, gender', 'numerical', 'integerOnly' => true),
            array('first_name, last_name', 'length', 'max' => 32, 'min' => 2),
            array('birth_date', 'safe'),
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

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'first_name' => t('First Name'),
            'last_name' => t('Last Name'),
            'gender' => t('Gender'),
            'birth_date' => t('Date of birth'),
        );
    }

    public function getGenderOptions()
    {
        return array(
            self::GENDER_MALE => t('Male'),
            self::GENDER_FEMALE => t('Female'),
        );
    }

    protected function beforeSave()
    {
        $this->first_name = trim(mb_ucfirst($this->first_name));
        $this->last_name = trim(mb_ucfirst($this->last_name));
        return parent::beforeSave();
    }

    public function getFullName()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

}