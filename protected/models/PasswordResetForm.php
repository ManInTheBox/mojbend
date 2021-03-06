<?php

/**
 * Description of PasswordReset
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class PasswordResetForm extends CFormModel
{
    public $email;
    public $captchaCode;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('email', 'required'),
            array('email', 'email', 'checkMX' => true),
            array('captchaCode',
               'ext.recaptcha.EReCaptchaValidator',
               'privateKey'=>'6Lfnfc8SAAAAAPWBDitXXn-GTvQgJotlQFuWU59b'
            ),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'email' => t('E-mail'),
            'captchaCode' => t('Verifikacioni kod'),
        );
    }

}