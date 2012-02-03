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
 * @property Group[] $groups
 * @property ListInstrument[] $instruments
 * @property User[] $fans
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
            'groups' => array(self::MANY_MANY, 'Group', 'artist_group(artist_id, group_id)'),
            'instruments' => array(self::MANY_MANY, 'ListInstrument', 'artist_instrument(artist_id, list_instrument_id)'),
            'fans' => array(self::MANY_MANY, 'User', 'fan_artist(artist_id, fan_id)'),
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