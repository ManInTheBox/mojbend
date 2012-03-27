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
            array('application.filters.ArtistFilter - logout'),
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
                    'home', 'search', 'view',
                ),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(
                    'register', 'login', 'activate', 'passwordReset',
                    'lostPassword',
                ),
                'users' => array('?'),
            ),
            array('allow',
                'actions' => array(
                    'logout', 'edit',
                ),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array(
                    'profilePicture',
                ),
                'users' => array('@'),
                'verbs' => array('POST'),
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
        $this->bodyClass = 'homepage';

        $user = new User();
        $person = new Person();

        if (isset($_POST['User']))
        {
            $saved = false;

            $user->attributes = $_POST['User'];
            $person->attributes = $_POST['Person'];

            if ($user->save())
            {
                $saved = true;

                $person->user_id = $user->id;
                $saved = $person->save();

                if ($user->isArtist)
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

                    $this->setFlashSuccess(t('Registracija je uspešno obavljena. Molimo Vas proverite e-mail poštu.'));
                    $this->redirect(a()->homeUrl);
                }
            }
        }

        $this->render('register', array('user' => $user, 'person' => $person));
    }

    public function actionLogin()
    {
        $this->bodyClass = 'homepage';

        $loginForm = new LoginForm();

        if (isset($_POST['LoginForm']))
        {
            $loginForm->attributes = $_POST['LoginForm'];

            if ($loginForm->validate() && $loginForm->login())
            {
                if (u()->returnUrl == r()->scriptUrl)
                {
                    $this->redirect(u()->homeUrl);
                }
                else
                {
                    $this->redirect(u()->returnUrl);
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
        $this->setFlashSuccess(t('Vaš nalog je sada aktivan. Molimo Vas sada se prijavite.'));
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

                    $this->setFlashInfo(t('Proces promene lozinke je upravo pokrenut. Molimo Vas proverite da proverite e-mail poštu.'));
                    $this->redirect(array('/user/login'));
                }
                catch (Exception $ex)
                {
                    $passwordResetForm->addError('email', t('E-mail adresa nije pronađena u našoj bazi podataka.'));
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
                $this->setFlashSuccess(t('Nova lozinka uspešno sačuvana.'));
                $this->setFlashInfo(t('Sada se možete prijaviti sa novom lozinkom.'));
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
        $user->person->displayDate();

        if ($user->isArtist)
        {
            $this->redirect(array('/artist/edit'));
        }

        $newPasswordForm = new NewPasswordForm();

        if (isset($_POST['User']))
        {
            $user->isArtist = $_POST['User']['isArtist'];
            $user->person->attributes = $_POST['Person'];
            $newPasswordForm->attributes = $_POST['NewPasswordForm'];

            if ($user->validate() & $user->person->validate() & $newPasswordForm->validate())
            {
                if ($newPasswordForm->shouldChange)
                {
                    $user->password = User::encryptPassword($newPasswordForm->newPassword, $user->salt);
                }

                $user->person->save(false);

                if ($user->isArtist)
                {
                    $artist = new Artist();
                    $artist->user_id = $user->id;
                    $artist->save(false);
                    u()->setState('artistPending', true);
                    u()->setState('homeUrl', url('/artist/view', array('uid' => u()->id)));

                    $this->setFlashSuccess();
                    $this->refresh();
                }

                $this->setFlashSuccess();
            }
        }
        $this->render('edit', array(
            'user' => $user,
            'person' => $user->person,
            'newPasswordForm' => $newPasswordForm
        ));
    }

    public function actionView($uid)
    {
        $user = $this->loadModel('User', $uid);

        $this->render('//user/view', array(
            'user' => $user,
            'person' => $user->person,
            'isOwner' => $user->id == u()->id,
        ));
    }

    public function actionProfilePicture()
    {
        if (ajax ())
        {
            $uid = $_POST['uid'];
            $pid = $_POST['pid'];
            $user = $this->loadModel('User', $uid);
            $user->profile_picture_id = $pid;
            $user->save();
            echo json_encode(array(
                'src' => $user->profilePicture->shortPath,
                'href' => $user->profilePicture->getShortPath('_large'),
            ));
            a()->end();
        }
        else
        {
            throw new CHttpException(400);
        }
    }

}
