<?php
/**
 * Description of NewPassword
 *
 */
class LostPasswordForm extends CFormModel
{
    public $new_password;
    public $new_password_repeat;
    public $user_id;
    public $token;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('new_password, new_password_repeat', 'required'),
            array('new_password', 'length', 'min' => 6, 'max' => 128),
            array('new_password', 'compare'),
        );
    }

    public function attributeLabels()
    {
        return array(
            'new_password' => t('Nova lozinka'),
            'new_password_repeat' => t('Ponovite lozinku'),
        );
    }
}