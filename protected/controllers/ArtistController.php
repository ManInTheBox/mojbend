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
        $artist = $this->loadModel('Artist', array(
            'condition' => 'user_id = :id',
            'with' => 'user',
            'params' => array(
                ':id' => u()->id
            ),
        ));
        $artist->scenario = 'edit';
        $newPasswordForm = new NewPasswordForm();
        
        if (isset ($_POST['Artist']))
        {
            $artist->user->isArtist = $_POST['User']['isArtist'];
            $artist->user->person->attributes = $_POST['Person'];
            $artist->attributes = $_POST['Artist'];
            $newPasswordForm->attributes = $_POST['NewPasswordForm'];
                
            if ($artist->user->validate() & $artist->user->person->validate() & $artist->validate() & $newPasswordForm->validate())
            {
                $artist->user->person->save();
                
                if (!$_POST['User']['isArtist'])
                {
                    $artist->delete();
                    u()->setState('artistPending', true, true);
                    $this->setFlashSuccess();
                    $this->redirect(array('/user/edit'));
                }
                
                $this->setFlashSuccess();
            }
        }
       
        $this->render('//artist/edit', array(
            'user' => $artist->user,
            'person' => $artist->user->person,
            'artist' => $artist,
            'newPasswordForm' => $newPasswordForm,
        ));
    }
    
    public function actionView($uid)
    {
    }
}