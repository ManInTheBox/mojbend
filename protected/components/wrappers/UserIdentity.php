<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

    const ERROR_STATUS_INACTIVE = 3;
    const ERROR_STATUS_PENDING = 4;
    const ERROR_STATUS_SUSPENDED = 5;
    const ERROR_STATUS_DEACTIVATED = 6;

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
        $user = User::model()->find('email = :email', array(':email' => $this->username));

        if (!isset($user))
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        else if (User::encryptPassword($this->password, $user->salt) !== $user->password)
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else if ($user->status == User::STATUS_INACTIVE)
        {
            $this->errorCode = self::ERROR_STATUS_INACTIVE;
        }
        else if ($user->status == User::STATUS_PENDING)
        {
            $this->errorCode = self::ERROR_STATUS_PENDING;
        }
        else if ($user->status == User::STATUS_SUSPENDED)
        {
            $this->errorCode = self::ERROR_STATUS_SUSPENDED;
        }
        else if ($user->status == User::STATUS_DEACTIVATED)
        {
            $this->errorCode = self::ERROR_STATUS_DEACTIVATED;
        }
        else
        {
            if ($user->artist && !$user->artist->list_artist_type_id)
            {
                $this->setState('artistPending', true);
            }
            
            $this->errorCode = self::ERROR_NONE;
            $this->_id = $user->id;
            $this->_username = $user->email;
            $this->setState('id', $user->id);
            $this->setState('email', $user->email);
            $this->setState('language', $user->language);
            $this->setState('homeUrl', $user->homeUrl);

            $cookie_token = Utility::generateHash();
            $user->cookie_token = $cookie_token;
            $user->logged_in = User::LOGGED_IN;
            $user->save(false);
            $this->setState('cookie_token', $cookie_token);
        }

        return !$this->errorCode;
    }

}