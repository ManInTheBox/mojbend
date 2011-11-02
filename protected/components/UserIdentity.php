<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    private $_id;
    private $_username;

    /**
     * Method simply returns unique identifier of currently logging user
     * @return int user ID
     */
    public function getId()
    {
        return (int) $this->_id;
    }
    
    /**
     * Method simply returns username of currently logging user
     * @return string username
     */
    public function getName()
    {
        return $this->_username;
    }

    /**
     * Authenticates a user.
     * Method performs authentication based on given username or email address.
     * 
     * Note that only one field <b>$this->username</b> will hold both values
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        $criteria = new CDbCriteria();
        $criteria->addColumnCondition(array(
            'username' => $this->username,
            'email' => $this->username,
                ), 'OR'
        );
        $user = User::model()->find($criteria);
        if (!isset($user))
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (User::encryptPassword($this->password) !== $user->password)
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $user->id;
            $this->_username = $user->username;
            $this->setState('email', $user->email);
        }

        return !$this->errorCode;
    }

}