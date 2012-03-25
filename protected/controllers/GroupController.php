<?php

/**
 * Description of GroupController
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class GroupController extends Controller
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
                'actions' => array(
                    'list', 'view', 'moreDescription',
                    'search',
                ),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(
                    'new', 'newFan', 'inviteMembers', 'join', 'edit',
                    'addPicture',
                ),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array(
                    'delete', 'removePicture', 'fan', 'profilePicture',
                ),
                'users' => array('@'),
                'verbs' => array('POST'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionList()
    {
        $groups = new CActiveDataProvider('Group', array(
                    'pagination' => array(
                        'pageSize' => 1,
                    ),
                ));
        
        $this->render('list', array('groups' => $groups));
    }

    public function actionView($gid)
    {
        $group = $this->loadModel('Group', $gid);
        
        if (strlen($group->description) > 150)
        {
            $group->description = substr($group->description, 0, 150);
            $group->description .= '... ' . l(t('još'), array(), array('id' => 'readMore'));
        }
        
        $group->displayDate();
        
        $pictures = Picture::model()->findAll(array(
            'condition' => 'related_id = :id AND related = :related',
            'params' => array(
                ':id' => $group->id,
                ':related' => 'group',
            ),
        ));
        
        $criteria = new CDbCriteria();
        $criteria->condition = 'fan_id = :id AND group_id = :gid';
        $criteria->params = array(':id' => u()->id, ':gid' => $gid);
        $fanButton = FanGroup::model()->exists($criteria) ? t('Vi ste fan') : t('Postani fan');
        
        $criteria = new CDbCriteria();
        $criteria->condition = 'artist_id = :id AND group_id = :gid';
        $criteria->params = array(':id' => u()->id, ':gid' => $gid);
        $joinButton = ArtistGroup::model()->exists($criteria) ? t('Napusti bend') : t('Priključi se');
        
        $this->render('view', array(
            'group' => $group, 
            'pictures' => $pictures,
            'isOwner' => Group::belongsToGroup($group->id),
            'fanButton' => $fanButton,
            'joinButton' => $joinButton,
        ));
    }

    public function actionNew()
    {
        if (!Artist::belongsToArtist(u()->id))
        {
            $this->setFlashInfo(t('Da biste osnovali bend morate se prvo afirmisati kao muzičar.'));
            $this->redirect(array('/user/edit'));
        }
        
        $group = new Group();

        if (isset($_POST['Group']))
        {
            $valid = false;
            $group->attributes = $_POST['Group'];
            $group->picture = CUploadedFile::getInstance($group, 'picture');

            if ($group->validate())
            {
                if (!$group->picture)
                {
                    $group->profile_picture_id = Picture::DEFAULT_ID;
                }
                else
                {
                    $picture = new Picture();
                    $picture->instance = $group->picture;
                    $picture->related_id = $group->id;
                    $picture->related = 'group';
                    $picture->size = $group->picture->size;
                    $picture->type = $group->picture->type;
                    $picture->extension = $group->picture->extensionName;
                    $picture->prepare()->save();
                    
                    $group->picture->saveAs($picture->realPath);

                    $picture->generateThumbs();

                    $group->profile_picture_id = $picture->id;
                }
                $group->save(false);

                $artistGroup = new ArtistGroup();
                $artistGroup->artist_id = u()->id;
                $artistGroup->group_id = $group->id;
                $artistGroup->role = ArtistGroup::ROLE_ADMIN;
                $artistGroup->save(false);

                $this->setFlashSuccess(t('Group succesfully created.'));
                $this->redirect(array('/group/list'));
            }
        }

        $this->render('new', array('group' => $group));
    }

    public function actionEdit($gid)
    {
        $group = $this->loadModel('Group', $gid);
        $group->displayDate();

        if (isset($_POST['Group']))
        {
            $group->attributes = $_POST['Group'];

            if ($group->save())
            {
                $this->setFlashSuccess();
                $this->redirect(array('/group/view', 'gid' => $gid));
            }
        }
        $this->render('edit', array('group' => $group));
    }

    public function actionDelete($gid)
    {
        $group = $this->loadModel('Group', $gid);

        if ($group->delete())
        {
            $this->setFlashSuccess(t('group deleted...'));
            $this->redirect(array('/group/list'));
        }
    }

    public function actionInviteMembers()
    {
        if (ajax() && post())
        {
            $gid = $_POST['gid'];
            $receivers = explode(',', $_POST['receivers']);

            $saved = true;
            foreach ($receivers as $receiver_id)
            {
                $request = new GroupMemberRequest();
                $request->sender_id = u()->id;
                $request->receiver_id = $receiver_id;
                $request->group_id = $gid;
                $saved = $saved & $request->save();
            }
            if ($saved)
            {
                echo 'ok';
            }
            else
                print_r($request->getErrors());
        }
        else
        {
            throw new CHttpException(404);
        }
    }

    public function actionFan()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'fan_id = :id AND group_id = :gid';
        $criteria->params = array(':id' => u()->id, ':gid' => $_POST['gid']);
        
        $fanGroup = FanGroup::model()->find($criteria);
        if (!$fanGroup)
        {
            $fanGroup = new FanGroup();
            $fanGroup->fan_id = u()->id;
            $fanGroup->group_id = $_POST['gid'];

            if ($fanGroup->save())
            {
                echo t('Vi ste fan');
            }
        }
        else
        {
            $fanGroup->delete();
            echo t('Postani fan');
        }
        
        a()->end();
    }

    public function actionJoin()
    {
        if (ajax() && post())
        {
            $request = new GroupMemberRequest();
            $request->sender_id = $_POST['requester'];
            $request->receiver_id = 1;
            $request->group_id = $_POST['gid'];

            if ($request->save())
                echo 'ok';
            else
                echo 'not ok';
        }
        else
        {
            throw new CHttpException(404);
        }
    }
    
    public function actionProfilePicture()
    {
        if (ajax())
        {
            $gid = $_POST['gid'];
            $pid = $_POST['pid'];

            if (Group::belongsToGroup($gid))
            {
                $group = $this->loadModel('Group', $gid);
                $group->profile_picture_id = $pid;
                $group->save();
                echo json_encode(array(
                    'src' => $group->profilePicture->shortPath,
                    'href' => $group->profilePicture->getShortPath('_large'),
                ));
                a()->end();
            }
        }
        else
        {
            throw new CHttpException(400);
        }
    }
    
    public function actionMoreDescription($gid)
    {
        $group = $this->loadModel('Group', $gid);
        echo $group->description;
        a()->end();
    }

}