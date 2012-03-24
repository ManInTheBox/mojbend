<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class LoginForm extends CFormModel
{

    public $email;
    public $password;
    public $rememberMe;
    private $_identity;

    /**
     * Declares the validation rules.
     * The rules state that email and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            // email and password are required
            array('email, password', 'required'),
            array('email', 'email'),
//            array('email', 'email', 'checkMX' => true),
            // rememberMe needs to be a boolean
            array('rememberMe', 'boolean'),
            // password needs to be authenticated
            array('password', 'authenticate'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email' => t('E-mail'),
            'password' => t('Lozinka'),
            'rememberMe' => t('Zapamti me za sledeći put'),
        );
    }

    /**
     * Authenticates the password.
     * This is the 'authenticate' validator as declared in rules().
     */
    public function authenticate($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $this->_identity = new UserIdentity($this->email, $this->password);
            if (!$this->_identity->authenticate())
            {
                switch ($this->_identity->errorCode)
                {
                    case UserIdentity::ERROR_STATUS_INACTIVE:
                        $this->addErrors(array(
                            'password' => t('Vaš nalog još uvek nije aktivan.'),
                            'email' => '', // don't display the same error message
                        ));
                        break;
                    case UserIdentity::ERROR_STATUS_PENDING:
                        $user = User::model()->findByAttributes(array('email' => $this->email));
                        $this->addErrors(array(
                            'password' => t(
                                            'Vaš nalog još uvek nije aktiviran. Molimo vas pratite link koji je poslat u e-mail poruci.<br />{link}', 
                                            array('{link}' => l('AKTIVIRAJ ODMAH', url('/user/activate', array('uid' => $user->id, 'token' => $user->activation_hash))),)),
                            'email' => '', // don't display the same error message
                            ));
                        break;
                    case UserIdentity::ERROR_STATUS_SUSPENDED:
                        $this->addErrors(array(
                            'password' => t('Vaš nalog je suspendovan.'),
                            'email' => '', // don't display the same error message
                        ));
                            
                        break;
                    case UserIdentity::ERROR_STATUS_DEACTIVATED:
                        $this->addError(array(
                            'password' => t('Vaš nalog je deaktiviran.'),
                            'email' => '', // don't display the same error message
                        ));
                        break;
                    default:
                        $this->addErrors(array(
                            'password' => t('Netačna e-mail adresa ili lozinka.'),
                            'email' => '', // don't display the same error message
                        ));
                        break;
                }
            }
        }
    }

    /**
     * Logs in the user using the given email and password in the model.
     * @return boolean whether login is successful
     */
    public function login()
    {
        if ($this->_identity === null)
        {
            $this->_identity = new UserIdentity($this->email, $this->password);
            $this->_identity->authenticate();
        }
        if ($this->_identity->errorCode === UserIdentity::ERROR_NONE)
        {
            $duration = $this->rememberMe ? 3600 * 24 * 30 : 0; // 30 days
            u()->login($this->_identity, $duration);
            return true;
        }
        else
            return false;
    }

}
