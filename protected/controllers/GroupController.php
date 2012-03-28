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
            array('application.filters.ArtistFilter'),
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
                    'new', 'inviteMembers', 'edit',
                    'addPicture', 'mine',
                ),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array(
                    'delete', 'removePicture', 'fan', 'profilePicture',
                    'join', 'removeFan',
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
        $this->sidebar = '//layouts/_groupsidebar';
        $this->sidebarData = Group::model()->findAll();

        $groups = new CActiveDataProvider('Group', array(
                    'pagination' => array(
                        'pageSize' => 2,
                    ),
                    'criteria' => array(
                        'order' => 'created_at ASC'
                    ),
                ));
        
        $this->render('list', array('groups' => $groups));
    }
    
    public function actionMine()
    {
        $this->sidebar = '//layouts/_groupsidebar';
        $this->sidebarData = Group::model()->findAll();

        $groups = new CActiveDataProvider('Group', array(
                    'pagination' => array(
                        'pageSize' => 2,
                    ),
                    'criteria' => array(
                        'with' => 'artists',
                        'condition' => '`artists`.user_id = :id',
                        'params' => array(':id' => u()->id),
                        'order' => 'created_at ASC'
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

                $this->setFlashSuccess(t('Bend je uspešno osnovan.'));
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

    public function actionDelete()
    {
        $gid = $_POST['gid'];
        $group = $this->loadModel('Group', $gid);

        if (Group::belongsToGroup($gid, ArtistGroup::ROLE_ADMIN))
        {
            $profilePicture = null;
            
            foreach ($group->pictures as $picture)
            {
                if ($picture->id != $group->profilePicture->id)
                {
                    $picture->remove();
                }
                else
                {
                    $profilePicture = $group->profilePicture;
                }
            }
            
            $group->delete();
            
            if ($profilePicture)
            {
                $profilePicture->remove();
            }
            
            $this->setFlashSuccess(t('Bend je uspešno obrisan sa sistema.'));
            $this->redirect(array('/group/list'));
        }
    }

    public function actionInviteMembers()
    {
        if (ajax() && post())
        {
            if (isset ($_POST['gid'], $_POST['receivers']))
            {
                $gid = $_POST['gid'];
                $receivers = array_unique($_POST['receivers']);

                $transaction = db()->beginTransaction();
                try
                {
                    foreach ($receivers as $receiver_id)
                    {
                        $request = new GroupMemberRequest();
                        $request->sender_id = u()->id;
                        $request->receiver_id = $receiver_id;
                        $request->group_id = $gid;
                        $request->save();
                        
                        $artistGroup = new ArtistGroup();
                        $artistGroup->artist_id = $receiver_id;
                        $artistGroup->group_id = $gid;
                        $artistGroup->role = ArtistGroup::ROLE_MEMBER;
                        $artistGroup->save();
                    }
                    $transaction->commit();
                }
                catch (Exception $ex)
                {
                    echo $ex->getMessage();
                }
            }
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
    
    public function actionRemoveFan()
    {
        $gid = $_POST['gid'];
        $uid = $_POST['uid'];
        
        if (Group::belongsToGroup($gid, ArtistGroup::ROLE_ADMIN))
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'fan_id = :id AND group_id = :gid';
            $criteria->params = array(':id' => $uid, ':gid' => $gid);

            $fanGroup = FanGroup::model()->find($criteria);
            
            if ($fanGroup)
            {
                $fanGroup->delete();
                $this->setFlashSuccess(t('Fan uspešno obrisan.'));
            }
            $this->redirect(array('/group/view', 'gid' => $gid));
        }
        else
        {
            throw new CHttpException(403);
        }
    }

    public function actionJoin()
    {
        $uid = isset ($_POST['uid']) ? $_POST['uid'] : u()->id;
        $gid = $_POST['gid'];

        if (!Artist::belongsToArtist($uid))
        {
            echo json_encode(array(
                'err' => true
            ));
            $this->setFlashInfo(t('Da biste se priključili bendu morate se prvo afirmisati kao muzičar.'));
        }
        else
        {
            $criteria = new CDbCriteria();
            $criteria->condition = 'artist_id = :id AND group_id = :gid';
            $criteria->params = array(':id' => $uid, ':gid' => $gid);

            $artistGroup = ArtistGroup::model()->find($criteria);
            if (!$artistGroup)
            {
                $artistGroup = new ArtistGroup();
                $artistGroup->artist_id = $uid;
                $artistGroup->group_id = $gid;
                $artistGroup->role = ArtistGroup::ROLE_MEMBER;

                if ($artistGroup->save(false))
                {
                    echo json_encode(array('msg' => t('Napusti bend')));
                }
            }
            else
            {
                $artistGroup->delete();
                GroupMemberRequest::model()->deleteAllByAttributes(array('receiver_id' => $uid, 'group_id' => $gid));
                if (ajax())
                {
                    echo json_encode(array('msg' => t('Priključi se')));
                }
                else
                {
                    $this->setFlashSuccess(t('Član uspešno obrisan.'));
                    $this->redirect(array('/group/view', 'gid' => $gid));
                }
            }
        }
        a()->end();
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