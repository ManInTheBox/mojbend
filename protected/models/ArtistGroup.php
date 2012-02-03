<?php

/**
 * This is the model class for table "artist_group".
 *
 * The followings are the available columns in table 'artist_group':
 * @property integer $artist_id
 * @property integer $group_id
 * @property string $created_at
 * @property integer $role
 *
 * @property Artist $artist
 * @property Group $group
 */
class ArtistGroup extends ActiveRecord
{
    const ROLE_ADMIN = 0;
    const ROLE_MODERATOR = 1;
    const ROLE_MEMBER = 2;

    /**
     * Returns the static model of the specified AR class.
     * @return ArtistGroup the static model class
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
        return 'artist_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('artist_id, group_id, created_at', 'required'),
            array('artist_id, group_id', 'numerical', 'integerOnly'=>true),
            array('created_at', 'length', 'max'=>10),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'artist' => array(self::BELONGS_TO, 'Artist', 'artist_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        return parent::beforeSave();
    }

    public function getRoles()
    {
        return array(
            self::ROLE_ADMIN => t('Administrator'),
            self::ROLE_MODERATOR => t('Moderator'),
            self::ROLE_MEMBER => t('Member'),
        );
    }
}