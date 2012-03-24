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
        if ($error = a()->errorHandler->error)
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
                    $error['message'] = t('Vaš zahtev nije ispravan. Molimo Vas da to više ne ponavljate.');
                    break;
                case 404:
                    $error['message'] = t('Tražena stranica nije pronađena.');
                    break;
                case 403:
                    $error['message'] = t('Nemate privilegije za pristup ovoj stranici.');
                    break;
                case 500:
                    $error['message'] = t('Nešto nije u redu i naši programeri rade na tome.');
                    break;
                default:
                    $error['message'] = t('Nešto nije u redu i naši programeri rade na tome.');
                    break;
            }

            if (ajax())
            {
                echo $error['message'];
                a()->end();
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

}