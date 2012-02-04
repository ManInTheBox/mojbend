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
        $groups = new CActiveDataProvider('Group', array(
            'pagination' => array(
                'pageSize' => 5,
            ),
        ));
        $this->render('list', array('groups' => $groups));
    }

    public function actionView($gid)
    {
        $group = $this->loadModel('Group', $gid);
        $this->render('view', array('group' => $group));
    }

    public function actionNew()
    {
        $group = new Group();

        if (isset($_POST['Group']))
        {
            $group->attributes = $_POST['Group'];

            if ($group->save())
            {
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

        if (isset ($_POST['Group']))
        {
            $group->attributes = $_POST['Group'];
            if ($group->save())
            {
                $this->setFlashSuccess('uspesno editovana...');
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

    public function actionNewFan($gid)
    {
        $fanGroup = new FanGroup();
        $fanGroup->fan_id = u()->id;
        $fanGroup->group_id = $gid;

        $fanGroup->save();
        $this->setFlashSuccess(t('You became fan.'));
        $this->redirect(u()->returnUrl);
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

}