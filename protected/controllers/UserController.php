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
                    'lostPassword',
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

    public function actionRegister()
    {
        $this->sidebar = '//layouts/blank_sidebar';
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

                    $this->setFlashSuccess(t('You have successfully registered. Check mail.'));
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
                if (isset(u()->returnUrl))
                {
                    $this->redirect(u()->returnUrl);
                }
                else
                {
                    $this->redirect(u()->homeurl);
                }
            }
        }

        $this->render('login', array('loginForm' => $loginForm));
    }

    public function actionActivate($uid, $token)
    {
        $criteria = new CDbCriteria(array(
                    'condition' => 'id = :id AND activation_hash = :hash',
                    'params' => array(':id' => $uid, ':hash' => $token),
                ));
        $user = $this->loadModel('User', $criteria);

        $user->status = User::STATUS_ACTIVE;
        $user->save(false);
        $this->setFlashSuccess(t('Your account is activated now. Please login to continue.'));
        $this->redirect(array('/user/login'));
    }

    public function actionPasswordReset()
    {
        $passwordResetForm = new PasswordResetForm();

        if (isset($_POST['PasswordResetForm']))
        {
            $passwordResetForm->attributes = $_POST['PasswordResetForm'];

            if ($passwordResetForm->validate())
            {
                try
                {
                    $user = $this->loadModel('User', array(
                        'condition' => 'email = :email',
                        'params' => array(':email' => $passwordResetForm->email)
                    ));

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
                    $this->redirect(array('/user/login'));
                }
                catch (Exception $ex)
                {
                    $passwordResetForm->addError('email', t('E-mail didn\'t found in our database.'));
                }
            }
        }

        $this->render('passwordReset', array('passwordResetForm' => $passwordResetForm));
    }

    public function actionLostPassword($uid, $token)
    {
        $user = $this->loadModel('User', new CDbCriteria(array(
                            'condition' => 'id = :id AND activation_hash = :hash',
                            'params' => array(':id' => $uid, ':hash' => $token),
                        )));

        $lostPasswordForm = new LostPasswordForm();
        $lostPasswordForm->user_id = $user->id;
        $lostPasswordForm->token = $user->activation_hash;

        if (isset($_POST['LostPasswordForm']))
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

    public function actionTest()
    {
        die('asdf');
    }

    public function actionLogout()
    {
        u()->logout();
        $this->redirect(a()->homeUrl);
    }

    public function actionEdit()
    {
        $user = $this->loadModel('User', u()->id);

        if (isset ($_POST['User']))
        {
            $user->attributes = $_POST['User'];
            $user->person->attributes = $_POST['Person'];

            if ($user->save() && $user->person->save())
            {
                $this->setFlashSuccess('uspesno editovan user');
            }
        }
        $this->render('edit', array('user' => $user, 'person' => $user->person));
    }

}
