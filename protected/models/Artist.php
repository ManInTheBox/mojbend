<?php

/**
 * This is the model class for table "artist".
 *
 * The followings are the available columns in table 'artist':
 * @property integer $user_id
 * @property integer $list_artist_type_id
 * @property string $description
 *
 * @property User $user
 * @property ListArtistType $listArtistType
 * @property ArtistInstrument[] $artistInstruments
 * @property FanArtist[] $fanArtists
 */
class Artist extends ActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @return Artist the static model class
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
        return 'artist';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id', 'required'),
            array('user_id, list_artist_type_id', 'numerical', 'integerOnly'=>true),
            array('description', 'safe'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'listArtistType' => array(self::BELONGS_TO, 'ListArtistType', 'list_artist_type_id'),
            'artistInstruments' => array(self::HAS_MANY, 'ArtistInstrument', 'artist_id'),
            'fanArtists' => array(self::HAS_MANY, 'FanArtist', 'artist_id'),
        );
    }

    /**
     * @return array customized attribute labels (name => label)
     */
    public function attributeLabels()
    {
        return array(
            'user_id' => t('User'),
            'list_artist_type_id' => t('List Artist Type'),
            'description' => t('Description'),
        );
    }
}