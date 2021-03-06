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
            array('application.filters.ArtistFilter - edit'),
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array(
                    'list', 'view', 'moreDescription',
                    'search', 'popular', 'newest'
                ),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array(
                    'new', 'newFan', 'inviteMembers', 'join', 'edit',
                    'addPicture', 'removePicture', 'editPicture',
                ),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array(
                    'delete', 'removePicture', 'fan', 'removeFan',
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
        $this->sidebar = '//layouts/_artistsidebar';
        $this->sidebarData = Artist::model()->findAll(array(
            'select' => '*, COUNT(fanArtist.artist_id) AS c',
            'with' => 'fanArtist',
            'group' => 'fanArtist.artist_id',
            'order' => 'c DESC',
            'limit' => 5,
        ));

        $artists = new CActiveDataProvider('Artist', array(
                    'pagination' => array(
                        'pageSize' => $this->pageSize,
                    ),
                    'criteria' => array(
                        'order' => 'created_at ASC',
                    ),
                ));

        $this->render('list', array('artists' => $artists));
    }
    
    public function actionNewest()
    {
        $this->sidebar = '//layouts/_artistsidebar';
        $this->sidebarData = Artist::model()->findAll(array(
            'select' => '*, COUNT(fanArtist.artist_id) AS c',
            'with' => 'fanArtist',
            'group' => 'fanArtist.artist_id',
            'order' => 'c DESC',
            'limit' => 5,
        ));

        $artists = new CActiveDataProvider('Artist', array(
                    'pagination' => array(
                        'pageSize' => $this->pageSize,
                    ),
                    'criteria' => array(
                        'order' => 'created_at DESC',
                    ),
                ));

        $this->render('list', array('artists' => $artists));
    }

    public function actionPopular()
    {
        $this->sidebar = '//layouts/_artistsidebar';
        $this->sidebarData = Artist::model()->findAll(array(
            'select' => '*, COUNT(fanArtist.artist_id) AS c',
            'with' => 'fanArtist',
            'group' => 'fanArtist.artist_id',
            'order' => 'c DESC',
            'limit' => 5,
        ));

        $artists = new CActiveDataProvider('Artist', array(
                    'pagination' => array(
                        'pageSize' => $this->pageSize,
                    ),
                    'criteria' => array(
                        'select' => '*, COUNT(fanArtist.artist_id) AS c',
                        'with' => 'fanArtist',
                        'group' => 'fanArtist.artist_id',
                        'order' => 'c DESC'
                    ),
                ));
        
        $this->render('list', array('artists' => $artists));
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
        $artist->user->person->scenario = 'artistEdit';
        $artist->user->person->displayDate();
        
        if ($artist->user->person->birth_date == $artist->emptyMessage)
        {
            $artist->user->person->birth_date = '';
        }        

        $newPasswordForm = new NewPasswordForm();

        if (isset($_POST['Artist']))
        {
            $artist->user->isArtist = $_POST['User']['isArtist'];
            $artist->user->person->attributes = $_POST['Person'];
            $artist->attributes = $_POST['Artist'];
            $artist->picture = CUploadedFile::getInstance($artist, 'picture');
            $newPasswordForm->attributes = $_POST['NewPasswordForm'];

            if ($artist->user->validate() & $artist->user->person->validate() & $artist->validate() & $newPasswordForm->validate())
            {
                if (!$artist->picture)
                {
                    $conditions = array(
                        'condition' => 'related_id = :id AND related = :related',
                        'params' => array(
                            ':id' => u()->id,
                            ':related' => 'artist',
                        ),
                    );
                    if (!Picture::model()->exists($conditions))
                    {
                        $artist->user->profile_picture_id = Picture::DEFAULT_ID;
                    }
                }
                else
                {
                    $picture = new Picture();
                    $picture->instance = $artist->picture;
                    $picture->related_id = u()->id;
                    $picture->related = 'artist';
                    $picture->size = $artist->picture->size;
                    $picture->type = $artist->picture->type;
                    $picture->extension = $artist->picture->extensionName;
                    $picture->prepare()->save();

                    $artist->picture->saveAs($picture->realPath);

                    $picture->generateThumbs();

                    $artist->user->profile_picture_id = $picture->id;
                }

                $artist->user->save(false);
                $artist->user->person->save(false);
                $artist->save(false);
                u()->setState('artistPending', true, true);

                if (!$_POST['User']['isArtist'])
                {
                    $artist->user->profile_picture_id = Picture::DEFAULT_ID;
                    $artist->user->save(false);

                    $pictures = Picture::model()->findAll(array(
                        'condition' => 'related_id = :id AND related = :related',
                        'params' => array(
                            ':id' => u()->id,
                            ':related' => 'artist',
                        ),
                            ));

                    foreach ($pictures as $picture)
                    {
                        $picture->remove();
                    }

                    $query = '
                                SELECT group_id
                                FROM artist_group
                                WHERE artist_id = :id AND role = :admin
                            ';
                    $params = array(
                        ':id' => u()->id,
                        ':admin' => ArtistGroup::ROLE_ADMIN,
                    );

                    $groups = sql($query)->queryAll(true, $params);

                    foreach ($groups as $group)
                    {
                        $pictures = Picture::model()->findAll(array(
                            'condition' => 'related_id = :id AND related = :related',
                            'params' => array(
                                ':id' => $group['group_id'],
                                ':related' => 'group',
                            ),
                                ));

                        foreach ($pictures as $picture)
                        {
                            $picture->remove();
                        }

                        Group::model()->deleteByPk($group['group_id']);
                    }

                    $artist->delete();
                    u()->setState('homeUrl', url('/user/view', array('uid' => u()->id)));


                    $this->setFlashSuccess();
                    $this->redirect(array('/user/edit'));
                }

                $this->setFlashSuccess();
                $this->redirect(array('/artist/view', 'uid' => $artist->user_id));
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
        $artist = $this->loadModel('Artist', $uid);
        
        if (strlen($artist->description) > 150)
        {
            $artist->description = substr($artist->description, 0, 150);
            $artist->description .= '... ' . l(t('još'), array(), array('id' => 'readMore'));
        }
        
        $artist->user->person->displayDate();

        $pictures = Picture::model()->findAll(array(
            'condition' => 'related_id = :id AND related = :related',
            'params' => array(
                ':id' => $uid,
                ':related' => 'artist',
            ),
                ));

        $criteria = new CDbCriteria();
        $criteria->condition = 'fan_id = :id AND artist_id = :uid';
        $criteria->params = array(':id' => u()->id, ':uid' => $uid);
        $fanButton = FanArtist::model()->exists($criteria) ? t('Vi ste fan') : t('Postani fan');

        $this->render('//artist/view', array(
            'artist' => $artist,
            'user' => $artist->user,
            'person' => $artist->user->person,
            'pictures' => $pictures,
            'isOwner' => u()->id == $artist->user_id,
            'fanButton' => $fanButton,
        ));
    }

    public function actionFan()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'fan_id = :id AND artist_id = :uid';
        $criteria->params = array(':id' => u()->id, ':uid' => $_POST['uid']);

        $fanArtist = FanArtist::model()->find($criteria);
        if (!$fanArtist)
        {
            $fanArtist = new FanArtist();
            $fanArtist->fan_id = u()->id;
            $fanArtist->artist_id = $_POST['uid'];

            if ($fanArtist->save())
            {
                echo t('Vi ste fan');
            }
        }
        else
        {
            $fanArtist->delete();
            echo t('Postani fan');
        }

        a()->end();
    }

    public function actionMoreDescription($uid)
    {
        $artist = $this->loadModel('Artist', $uid);
        echo $artist->description;
        a()->end();
    }

    public function actionRemoveFan()
    {
        $uid = $_POST['uid'];
        
        $criteria = new CDbCriteria();
        $criteria->condition = 'fan_id = :id AND artist_id = :artist';
        $criteria->params = array(':id' => $uid, ':artist' => u()->id);

        $fanArtist = FanArtist::model()->find($criteria);

        if ($fanArtist)
        {
            $fanArtist->delete();
            $this->setFlashSuccess(t('Fan uspešno obrisan.'));
        }
        $this->redirect(array('/artist/view', 'uid' => u()->id));
    }    
}