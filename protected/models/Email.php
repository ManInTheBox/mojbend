<?php

Yii::import('ext.mailer.EMailer');

/**
 * This is the model class for table "email".
 *
 * The followings are the available columns in table 'email':
 * @property integer $id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $status
 * @property integer $type
 * @property integer $priority
 * @property integer $sending_time
 * @property string $hash
 * @property string $error_message
 * @property string $host
 * @property string $host_name
 * @property string $protocol
 * @property string $from_address
 * @property string $from_name
 * @property string $receiver_address
 * @property string $receiver_name
 * @property string $receivers
 * @property string $subject
 * @property string $body
 * @property string $charset
 *
 * @property User $user
 */
class Email extends ActiveRecord
{
    const STATUS_NOT_SENT = 0;
    const STATUS_SENT = 1;

    const PRIORITY_HIGHEST = 1;
    const PRIORITY_HIGH = 2;
    const PRIORITY_NORMAL = 3;
    const PRIORITY_LOW = 4;
    const PRIORITY_LOWEST = 5;

    const TYPE_REGISTER = 1;
    const TYPE_PASSWORD_RESET = 2;
    const TYPE_INTERNAL_ERROR = 3;

    const MAX_SENDING_ATTEMPTS = 5;

    private $_bodyData;
    public $mailer;

    /**
     * Returns the static model of the specified AR class.
     * @return Email the static model class
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
        return 'email';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('created_at, type, hash, subject, body', 'required'),
            array('user_id, created_at, status, type, priority, sending_time', 'numerical', 'integerOnly' => true),
            array('error_message, host, host_name, protocol, from_address, from_name, receiver_address, receiver_name, receivers', 'safe'),
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

    public function __construct($scenario = 'insert')
    {
        parent::__construct($scenario);
        $this->mailer = new EMailer();
    }

    public function send($type = null)
    {
        $result = false;

        if ($type)
        {
            $this->applyConfig($type);
        }

        return $this->save(false);
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord)
        {
            $this->created_at = time();
            $this->hash = Utility::generateHash();

            if (empty($this->receiver_name))
            {
                $this->receiver_name = $this->receiver_address;
            }

            if (!empty ($this->receivers))
            {
                $this->receivers = json_encode($this->receivers);
            }
        }
        return parent::beforeSave();
    }

    public function applyConfig($type)
    {
        $config = $this->getConfig($type);
        foreach ($config as $property => $value)
        {
            $this->$property = $value;
        }
    }

    public function getConfig($type)
    {
        $config = array();
        
        switch ($type)
        {
            case self::TYPE_REGISTER:
                $config = array(
                    'subject' => t('Mojbend.rs Account Activation'),
                    'type' => self::TYPE_REGISTER,
                    'body' => c()->renderPartial('//emails/_register', $this->bodyData, true),
                    'priority' => self::PRIORITY_HIGHEST,
                );
                break;
            case self::TYPE_PASSWORD_RESET:
                $config = array(
                    'subject' => t('Mojbend.rs Lost Password'),
                    'body' => c()->renderPartial('//emails/_password_reset', $this->bodyData, true),
                    'type' => self::TYPE_PASSWORD_RESET,
                    'priority' => self::PRIORITY_HIGH,
                );
                break;
            case self::TYPE_INTERNAL_ERROR:
                $config = array(
                    'subject' => 'Error on Mojbend.rs',
                    'body' => c()->renderPartial('//emails/_internal_error', $this->bodyData, true),
                    'type' => self::TYPE_INTERNAL_ERROR,
                    'priority' => self::PRIORITY_HIGHEST,
                    'from_name' => 'Mojbend.rs Error Reporter',
                    'from_address' => 'internalerror@mojbend.rs',
                );
                break;
            default:
                throw new CException('No config defined!');
                break;
        }

        return $config;
    }

    public function setBodyData($value)
    {
        $this->_bodyData = array_merge(array('email' => $this->receiver_address), $value);
    }

    public function getBodyData()
    {
        return $this->_bodyData;
    }

    public function processSending()
    {
        $this->mailer->Host = $this->host;
        $this->mailer->Mailer = $this->protocol;
        $this->mailer->From = $this->from_address;
        $this->mailer->FromName = $this->from_name;
        $this->mailer->CharSet = $this->charset;

        $this->mailer->ClearAllRecipients();

        if (!empty($this->receivers))
        {
            foreach ($this->receivers as $address => $name)
            {
                $this->mailer->AddAddress($address, $name);
            }
        }
        else
        {
            $this->mailer->AddAddress($this->receiver_address, $this->receiver_name);
        }

        $this->mailer->Subject = $this->subject;
        $this->mailer->AltBody = '';
        $this->mailer->MsgHTML($this->body);

        return $this->mailer->Send();
    }

    public function validateAddress()
    {
        if ($this->type != Email::TYPE_INTERNAL_ERROR)
        {
            if (!empty ($this->receiver_address))
            {
                $domain = substr($this->receiver_address, strpos($this->receiver_address, '@') + 1);
                if (!checkdnsrr($domain, 'MX'))
                {
                    return false; // email doesn't exists so get away from here
                }
            }
        }

        return true; // everything is ok
    }

    protected function afterFind()
    {
        if (!empty ($this->receivers))
        {
            $this->receivers = json_decode($this->receivers, true);
        }
        parent::afterFind();
    }

}