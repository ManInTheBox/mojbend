<?php

/**
 * This is the model class for table "group".
 *
 * The followings are the available columns in table 'group':
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $created_at
 * @property string $founded_date
 * @property string $official_website
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $youtube_url
 *
 * @property FanGroup[] $fanGroups
 * @property UserGroup[] $userGroups
 */
class Group extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Group the static model class
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
        return 'group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('name', 'required'),
            array('name', 'length', 'max'=>64),
            array('created_at', 'length', 'max'=>10),
            array('official_website, facebook_url, twitter_url, youtube_url', 'length', 'max'=>256),
            array('description, founded_date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'fanGroups' => array(self::HAS_MANY, 'FanGroup', 'group_id'),
            'userGroups' => array(self::HAS_MANY, 'UserGroup', 'group_id'),
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => t('Name'),
            'description' => t('Description'),
            'created_at' => t('Created At'),
            'founded_date' => t('Founded Date'),
            'official_website' => t('Official Website'),
            'facebook_url' => t('Facebook Url'),
            'twitter_url' => t('Twitter Url'),
            'youtube_url' => t('Youtube Url'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        $this->name = trim(mb_ucwords($this->name));
        return parent::beforeSave();
    }
}