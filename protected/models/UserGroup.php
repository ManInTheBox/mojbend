<?php

/**
 * This is the model class for table "user_group".
 *
 * The followings are the available columns in table 'user_group':
 * @property integer $user_id
 * @property integer $group_id
 * @property integer $created_at
 * @property integer $status
 * @property integer $list_role_id
 *
 * @property User $user
 * @property Group $group
 * @property ListRole $listRole
 */
class UserGroup extends ActiveRecord
{

    const STATUS_ACCEPTED = 0;
    const STATUS_DECLINED = 1;

    /**
     * Returns the static model of the specified AR class.
     * @return UserGroup the static model class
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
        return 'user_group';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('user_id, group_id, created_at, status, list_role_id', 'required'),
            array('user_id, group_id, created_at, status, list_role_id', 'numerical', 'integerOnly'=>true),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'user' => array(self::BELONGS_TO, 'User', 'user_id'),
            'group' => array(self::BELONGS_TO, 'Group', 'group_id'),
            'listRole' => array(self::BELONGS_TO, 'ListRole', 'list_role_id'),
        );
    }
    
    protected function beforeSave()
    {
        $this->created_at = time();
        return parent::beforeSave();
    }
}