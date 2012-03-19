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
 * @property string $location
 * @property string $facebook_url
 * @property string $twitter_url
 * @property string $youtube_url
 * @property integer $profile_picture_id
 *
 * @property Artist[] $artists
 * @property User[] $fans
 * @property Picture[] $pictures
 */
class Group extends ActiveRecord
{

    public $picture;

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
            array('picture', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png'),
            array('official_website, facebook_url, twitter_url, youtube_url', 'url', 'defaultScheme' => 'http'),
            array('name', 'length', 'max' => 64),
            array('created_at', 'length', 'max' => 10),
            array('official_website, facebook_url, twitter_url, youtube_url', 'length', 'max' => 256),
            array('description, founded_date', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'artists' => array(self::MANY_MANY, 'Artist', 'artist_group(group_id, artist_id)'),
            'fans' => array(self::MANY_MANY, 'User', 'fan_group(group_id, fan_id)'),
//            'admins' => array(self::MANY_MANY, 'Artist', 'artist_group(artist_id, group_id)',
//                'condition' => 'admins.role = ' . ArtistGroup::ROLE_ADMIN),
            'profilePicture' => array(self::BELONGS_TO, 'Picture', 'profile_picture_id'),
            'pictures' => array(self::HAS_MANY, 'Picture', 'group_id'),
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'name' => t('Naziv'),
            'description' => t('Opis'),
            'founded_date' => t('Datum osnivanja'),
            'official_website' => t('Zvanični Website'),
            'location' => t('Lokacija'),
            'facebook_url' => t('Facebook'),
            'twitter_url' => t('Twitter'),
            'youtube_url' => t('Youtube'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        $this->name = trim(mb_ucwords($this->name));
        return parent::beforeSave();
    }

    public function getAdmins()
    {
        return $this->artists(array('condition' => 'role = ' . ArtistGroup::ROLE_ADMIN));
    }

    public function __get($name)
    {
        $v = parent::__get($name);

        if ($this->getScenario() == 'preview')
        {
            if (empty($v) || $v === '0000-00-00')
            {
                return $this->emptyMessage;
            }
            else
            {
                return $v;
            }
        }
        else
        {
            return $v;
        }
    }

    public function localizeDate($separator = '.', $explode = '-')
    {
        $dateParts = explode($explode, $this->founded_date);
        if (!empty($dateParts))
        {
            $this->founded_date = "$dateParts[2]$separator$dateParts[1]$separator$dateParts[0]";
        }
    }

}