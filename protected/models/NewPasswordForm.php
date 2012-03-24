<?php

/**
 * Description of NewPasswordForm
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class NewPasswordForm extends CFormModel
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordRepeat;
    public $shouldChange;

    /**
     * Declares the validation rules.
     * The rules state that username and password are required,
     * and password needs to be authenticated.
     */
    public function rules()
    {
        return array(
            array('oldPassword', 'checkOldPassword'),
            array('oldPassword, newPassword_repeat', 'safe'),
            array('newPassword', 'length', 'min' => 6, 'max' => 128),
            array('newPasswordRepeat', 'compare', 'compareAttribute' => 'newPassword', 'message' => t('Lozinke se ne poklapaju.')),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels()
    {
        return array(
            'oldPassword' => t('Stara lozinka'),
            'newPassword' => t('Nova lozinka'),
            'newPasswordRepeat' => t('Ponovite lozinku'),
        );
    }
    
    public function checkOldPassword()
    {
        if (!empty($this->newPassword))
        {
            $user = User::model()->findByPk(u()->id);
            $oldPassword = User::encryptPassword($this->oldPassword, $user->salt);

            if ($oldPassword != $user->password)
            {
                $this->addError('oldPassword', t('Stara lozinka nije tačna.'));
            }
        }
    }
    
    protected function afterValidate()
    {
        $e = $this->getErrors();
        if (empty($e) && !empty($this->newPassword))
        {
            $this->shouldChange = true;
        }
        parent::afterValidate();
    }

}