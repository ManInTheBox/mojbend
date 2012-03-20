<?php

/**
 * Description of ArtistController
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class ArtistController extends Controller
{

    public $defaultAction = 'list';
    
    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('list', 'view'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(
                    'new', 'newFan', 'inviteMembers', 'join', 'edit',
                ),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('delete'),
                'users' => array('@'),
//                'verbs' => array('POST'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }
    
    public function actionList()
    {
        echo 'list akcija';
    }
    
    public function actionEdit()
    {
        $user = $this->loadModel('User', u()->id);
        
        if (isset ($_POST['Artist']))
        {
            $user->attributes = $_POST['User'];
            $user->person->attributes = $_POST['Person'];
            $user->artist->attributes = $_POST['Artist'];
            
            if ($user->save() && $user->person->save() && $user->artist->save())
            {
                $this->setFlashSuccess();
                $this->setFlashInfo('yeaaaaaaaaaaaaah');
//                $this->redirect(array('/artist/list'));
            }
        }
       
        $this->render('//artist/edit', array(
            'user' => $user,
            'person' => $user->person,
            'artist' => $user->artist,
        ));
    }
    
    public function actionView($uid)
    {
    }
}