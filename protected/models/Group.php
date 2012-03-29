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
            array('picture', 'file', 'allowEmpty' => true, 'types' => 'jpg, gif, png', 'maxSize' => 1024 * 1024 * 2, 'tooLarge' => t('Dozvoljena veličina slike je 2MB.')),
            array('official_website, facebook_url, twitter_url, youtube_url', 'url', 'defaultScheme' => 'http'),
            array('name', 'length', 'max' => 64),
            array('created_at', 'length', 'max' => 10),
            array('location', 'length', 'max' => 128),
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
            'artistGroup' => array(self::HAS_ONE, 'ArtistGroup', 'group_id'),
            'fanGroup' => array(self::HAS_ONE, 'FanGroup', 'group_id'),
            'artists' => array(self::MANY_MANY, 'Artist', 'artist_group(group_id, artist_id)'),
            'fans' => array(self::MANY_MANY, 'User', 'fan_group(group_id, fan_id)'),
            'profilePicture' => array(self::BELONGS_TO, 'Picture', 'profile_picture_id'),
            'pictures' => array(self::HAS_MANY, 'Picture', 'related_id',
                'condition' => 'related = "group"'
            ),
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
            'youtube_url' => t('You Tube'),
            'picture' => t('Slika'),
        );
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {
            $this->created_at = time();
        }
        $this->name = trim(mb_ucwords($this->name));
        return parent::beforeSave();
    }

    public function getAdmins()
    {
        return $this->artists(array('condition' => 'role = ' . ArtistGroup::ROLE_ADMIN));
    }
    
    public static function belongsToGroup($gid, $role = 'all')
    {
        if ($role == 'all')
        {
            $query = '
                        SELECT 1
                        FROM artist_group
                        WHERE artist_id = :uid AND group_id = :gid AND (role = :admin OR role = :moderator);
                    ';
            $params = array(
                ':uid' => u()->id,
                ':gid' => $gid,
                ':admin' => ArtistGroup::ROLE_ADMIN,
                ':moderator' => ArtistGroup::ROLE_MODERATOR,
            );
        }
        else
        {
            $query = '
                        SELECT 1
                        FROM artist_group
                        WHERE artist_id = :uid AND group_id = :gid AND role = :role;
                    ';
            $params = array(
                ':uid' => u()->id,
                ':gid' => $gid,
                ':role' => $role,
            );
        }

        return sql($query)->queryScalar($params);
    }

    public function getUrl()
    {
        return url('/group/view', array('gid' => $this->id));
    }

}