<?php

/**
 * This is the model class for table "group_member_request".
 *
 * The followings are the available columns in table 'group_member_request':
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property integer $group_id
 * @property string $created_at
 *
 * @property Group $group
 * @property Artist $sender
 * @property Artist $receiver
 */
class GroupMemberRequest extends ActiveRecord
{

    /**
     * Returns the static model of the specified AR class.
     * @return GroupMemberRequest the static model class
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
        return 'group_member_request';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('sender_id, receiver_id, group_id', 'required'),
            array('sender_id, receiver_id, group_id', 'numerical', 'integerOnly'=>true),
            array('created_at', 'length', 'max'=>10),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'sender' => array(self::BELONGS_TO, 'Artist', 'sender_id'),
            'receiver' => array(self::BELONGS_TO, 'Artist', 'receiver_id'),
        );
    }

    protected function beforeSave()
    {
        $this->created_at = time();
        return parent::beforeSave();
    }
}