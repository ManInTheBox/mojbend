<?php

class UserController extends Controller
{

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    public $defaultAction = 'home';

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl',
            array('application.filters.UserReadyFilter + home'),
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array(
                    'home', 'register', 'login', 'activate', 'passwordReset',
                ),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    /**
     * Lists all models.
     */
    public function actionHome()
    {
        $dataProvider = new CActiveDataProvider('User');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id)
    {
        $model = User::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionRegister()
    {
        $user = new User();
        $person = new Person();
        
        if (isset($_POST['User']))
        {
            $saved = false;
            
            $user->attributes = $_POST['User'];
            if ($user->save())
            {
                $saved = true;

                $person->attributes = $_POST['Person'];
                $person->user_id = $user->id;
                $saved = $person->save();
                
                if ($user->is_artist)
                {
                    $artist = new Artist();
                    $artist->user_id = $user->id;
                    $saved = $saved & $artist->save();
                }

                if ($saved)
                {
                    $email = new Email();
                    $email->user_id = $user->id;
                    $email->receiver_address = $user->email;
                    $email->receiver_name = $person->fullName;
                    $email->bodyData = array(
                        'activation_link' => l(
                                url('/user/activate', array('uid' => $user->id, 'token' => $user->activation_hash), true),
                                url('/user/activate', array('uid' => $user->id, 'token' => $user->activation_hash), true)
                        ),
                    );
                    $email->send(Email::TYPE_REGISTER);

                    $this->redirect(array('home', 'uid' => $user->id));
                }
            }
        }

        $this->render('register', array('user' => $user, 'person' => $person));
    }

    public function actionLogin()
    {
        $loginForm = new LoginForm();

        if (isset($_POST['LoginForm']))
        {
            $loginForm->attributes = $_POST['LoginForm'];
            
            if ($loginForm->validate() && $loginForm->login())
            {
                // TODO: da li je neophodan returnUrl?
                if (isset (u()->returnUrl))
                {
                    $this->redirect(u()->returnUrl);
                }
                else
                {
                    $this->redirect(array('home', 'uid' => u()->id));
                }
            }
        }

        $this->render('login', array('loginForm' => $loginForm));
    }

    public function actionActivate($uid, $token)
    {
        $user = User::model()->findByAttributes(array('id' => $uid, 'activation_hash' => $token));

        if ($user)
        {
            $user->status = User::STATUS_ACTIVE;
            $user->save(false);
            $this->setFlashSuccess(t('Your account is activated now. Please login to continue.'));
            $this->redirect(array('/user/login'));
        }
        else
        {
            throw new CHttpException(404);
        }
    }

    public function actionPasswordReset()
    {
        $passwordResetForm = new PasswordResetForm();

        if (isset ($_POST['PasswordResetForm']))
        {
            $passwordResetForm->attributes = $_POST['PasswordResetForm'];

            if ($passwordResetForm->validate())
            {
                $user = User::model()->findByAttributes(array('email' => $passwordResetForm->email));

                if ($user)
                {
                    $email = new Email();
                    $email->user_id = $user->id;
                    $email->receiver_address = $user->email;
                    $email->bodyData = array(
                        'link' => l(
                                url('/user/lostPassword', array('uid' => $user->id, 'token' => $user->activation_hash), true),
                                url('/user/lostPassword', array('uid' => $user->id, 'token' => $user->activation_hash), true)
                        )
                    );
                    $email->send(Email::TYPE_PASSWORD_RESET);

                    $this->setFlashInfo(t('Read email.'));
                    $this->redirect(array('user/login'));
                }
                else
                {
                    $passwordResetForm->addError('email', t('E-mail didn\'t found in our database.'));
                }
            }
        }

        $this->render('passwordReset', array('passwordResetForm' => $passwordResetForm));
    }

    public function actionLostPassword($uid, $token)
    {
        $user = User::model()->findByAttributes(array('id' => $uid, 'activation_hash' => $token));

        if ($user)
        {
            $lostPasswordForm = new LostPasswordForm();
            $lostPasswordForm->user_id = $user->id;
            $lostPasswordForm->token = $user->activation_hash;

            if (isset ($_POST['LostPasswordForm']))
            {
                $lostPasswordForm->attributes = $_POST['LostPasswordForm'];

                if ($lostPasswordForm->validate())
                {
                    $salt = Utility::generateHash();
                    $user->password = User::encryptPassword($lostPasswordForm->new_password, $salt);
                    $user->salt = $salt;
                    $user->activation_hash = Utility::generateHash();
                    $user->save(false);
                    $this->setFlashSuccess(t('new password done...'));
                    $this->redirect(array('/user/login'));
                }
            }

            $this->render('/user/lostPassword', array('lostPasswordForm' => $lostPasswordForm));
        }
        else
        {
            throw new CHttpException(404);
        }
    }

}
