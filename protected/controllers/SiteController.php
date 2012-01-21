<?php

class SiteController extends Controller
{

    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex()
    {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if ($error = Yii::app()->errorHandler->error)
        {
            if ($error['code'] == 500)
            {
                $userId = null;

                if (!guest())
                {
                    $userId = u()->id;
                }
                
                try
                {
                    $email = new Email();
                    $email->receivers = array(
                        'zarko.stankovic@itsmyplay.com' => 'Zarko Stankovic',
                    );
                    $email->bodyData = array(
                        'time' => gmdate('Y-m-d H:i:s'),
                        'currentUrl' => r()->url,
                        'referrer' => r()->urlReferrer,
                        'browser' => r()->userAgent,
                        'userId' => $userId,
                        'type' => $error['type'],
                        'message' => $error['message'],
                        'file' => $error['file'],
                        'line' => $error['line'],
                        'stackTrace' => $error['trace'],
                    );
                    $email->send(Email::TYPE_INTERNAL_ERROR);
                }
                catch (Exception $ex)
                {
                    // let error page displays its fancy content
                }
            }

            switch ($error['code'])
            {
                case 400:
                    $error['message'] = t('Your request is invalid. Please do not repeat that again.');
                    break;
                case 404:
                    $error['message'] = t('The requested page wasn\'t found.');
                    break;
                case 403:
                    $error['message'] = t('You don\'t have permissions to access this page.');
                    break;
                case 500:
                    $error['message'] = t('Something went wrong and our engineers are working on it.');
                    break;
                default:
                    $error['message'] = t('Something went wrong and our engineers are working on it.');
                    break;
            }

            if (ajax())
            {
                echo $error['message'];
                Yii::app()->end();
            }
            else
            {
                $this->render('error', $error);
            }
        }
        else
        {
            throw new CHttpException(404);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm']))
        {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate())
            {
                $headers = "From: {$model->email}\r\nReply-To: {$model->email}";
                mail(Yii::app()->params['adminEmail'], $model->subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm']))
        {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

}