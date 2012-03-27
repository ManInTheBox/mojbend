<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{

    /**
     * @var string the default layout for the controller view. Defaults to '//layouts/column1',
     * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
     */
    public $layout = '//layouts/column1';
    /**
     * @var array context menu items. This property will be assigned to {@link CMenu::items}.
     */
    public $menu = array();
    /**
     * @var array the breadcrumbs of the current page. The value of this property will
     * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
     * for more details on how to specify this property.
     */
    public $breadcrumbs = array();

    public $sidebar = '//layouts/_sidebar';

    public $sidebarData = array();

    public $slidesData = array();

    public $bodyClass = 'noheader';

    public $footer = '//layouts/_footer';

    public function init()
    {
        $groups = Group::model()->findAll();
        $artist = Artist::model()->findAll();

        $this->slidesData = CMap::mergeArray($groups, $artist);
    }

    public function setFlash($key, $value, $defaultValue = null)
    {
        u()->setFlash($key, $value, $defaultValue);
    }

    public function setFlashSuccess($value = NULL, $defaultValue = null)
    {
        if ($value === NULL)
        {
            $value = t('Izmene uspešno sačuvane.');
        }
        $this->setFlash('success', $value, $defaultValue);
    }

    public function setFlashError($value = NULL, $defaultValue = null)
    {
        if ($value === NULL)
        {
            $value = t('Dogodila se greška.');
        }
        $this->setFlash('error', $value, $defaultValue);
    }

    public function setFlashInfo($value, $defaultValue = null)
    {
        $this->setFlash('info', $value, $defaultValue);
    }

    public function hasFlash($key)
    {
        return u()->hasFlash($key);
    }

    public function hasFlashSuccess()
    {
        return $this->hasFlash('success');
    }

    public function hasFlashError()
    {
        return $this->hasFlash('error');
    }

    public function hasFlashInfo()
    {
        return $this->hasFlash('info');
    }

    public function getFlash($key)
    {
        return u()->getFlash($key);
    }

    public function getFlashSuccess()
    {
        return $this->getFlash('success');
    }

    public function getFlashError()
    {
        return $this->getFlash('error');
    }

    public function getFlashInfo()
    {
        return $this->getFlash('info');
    }

    public function renderFlash($return = FALSE, $flashType = null, $additionalClasses = array())
    {
        if ($this->hasFlashSuccess())
        {
            $this->renderPartial('//flash/_success', array('message' => $this->getFlashSuccess()));
        }
        if ($this->hasFlashError())
        {
            $this->renderPartial('//flash/_error', array('message' => $this->getFlashError()));
        }
        if ($this->hasFlashInfo())
        {
            $this->renderPartial('//flash/_info', array('message' => $this->getFlashInfo()));
        }
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($class, $condition, $params = array(), $errorCode = 404)
    {
        $model = null;

        if (is_numeric($condition))
        {
            $model = $class::model()->findByPk($condition);
        }
        else if (is_array($condition) || $condition instanceof CDbCriteria)
        {
            $model = $class::model()->find($condition, $params);
        }

        if ($model === null)
        {
            throw new CHttpException($errorCode);
        }

        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model)
    {
        $splited = Utility::splitByCaps(get_class($model));
        $formName = strtolower(str_replace(' ', '-', $splited));
        preg_match('/-form$/', $formName, $matches);

        if (empty ($matches))
        {
            $formName .= '-form';
        }
        
        if (isset($_POST['ajax']) && $_POST['ajax'] === $formName)
        {
            echo CActiveForm::validate($model);
            a()->end();
        }
    }
    
    public function actionAddPicture($id, $related)
    {
        $id = $this->checkMediaAccess($id, $related);
        
        $picture = new Picture();
        
        $identifier = $related == 'group' ? 'gid' : 'uid';
        $backUrl = array("/$related/view", $identifier => $id);
        
        if (isset($_POST['Picture']))
        {
            $picture->attributes = $_POST['Picture'];
            $picture->related_id = $id;
            $picture->related = $related;
            $picture->instance = CUploadedFile::getInstance($picture, 'instance');
            
            if ($picture->validate())
            {
                $picture->size = $picture->instance->size;
                $picture->type = $picture->instance->type;
                $picture->extension = $picture->instance->extensionName;
                $picture->prepare()->save();
                $picture->instance->saveAs($picture->realPath);
                $picture->generateThumbs();

                $this->setFlashSuccess(t('Nova slika uspešno objavljena.'));
                $this->redirect($backUrl);
            }
        }
        
        $this->render('//common/addPicture', array(
            'picture' => $picture,
            'backUrl' => $backUrl,
        ));
    }
    
    public function actionRemovePicture()
    {
        $id = $_POST['id'];
        $related = $_POST['related'];
        $pid = $_POST['pid'];
        
        $id = $this->checkMediaAccess($id, $related);
        $picture = $this->loadModel('Picture', $pid);
        
        $picture->remove();
        $this->setFlashSuccess(t('Slika uspešno obrisana.'));
        
        $identifier = $related == 'group' ? 'gid' : 'uid';
        $this->redirect(array("/$related/view", $identifier => $id));
    }
    
    private function checkMediaAccess($id, $related)
    {
        switch ($related)
        {
            case 'group';
                if (!Picture::belongsToGroup($id))
                {
                    throw new CHttpException(403);
                }
                break;
            case 'artist':
                if (!Picture::belongsToArtist($id))
                {
                    throw new CHttpException(403);
                }
                break;
            case 'user':
                $id = u()->id;
                break;
            default:
                throw new CHttpException(400);
                break;
        }
        
        return $id;
    }
    
    public function actionSearch()
    {
        if (ajax())
        {
            $q = $_GET['term'];
            $result = array();

            if (isset ($_GET['artist']))
            {
                $artists = Artist::model()->findAll(array(
                    'with' => 'user.person',
                    'condition' => 'person.first_name LIKE :q OR person.last_name LIKE :q',
                    'params' => array(':q' => "%$q%")
                ));
                
                foreach ($artists as $artist)
                {
                    $result[] = array(
                        'id' => $artist->user_id,
                        'label' => $artist->user->person->fullName,
                    );
                }
                
                echo json_encode($result);
                a()->end();
            }
            
            $users = Person::model()->findAll('first_name LIKE :q OR last_name LIKE :q', array(':q' => "%$q%"));
            $groups = Group::model()->findAll('name LIKE :name', array(':name' => "%$q%"));
            
            $targets = array_merge($users, $groups);
            
            foreach ($targets as $target)
            {
                if ($target instanceof Person)
                {
                    if ($target->user->artist)
                    {
                        $result[] = array(
                            'label' => $target->fullName,
                            'location' => url('/artist/view', array('uid' => $target->user_id))
                        );
                    }
                    else
                    {
                        $result[] = array(
                            'label' => $target->fullName,
                            'location' => url('/user/view', array('uid' => $person->user_id))
                        );
                    }
                }
                else if ($target instanceof Group)
                {
                    $result[] = array(
                        'label' => $target->name,
                        'location' => url('/group/view', array('gid' => $target->id))
                    );
                }
            }
            
            echo json_encode($result);
            a()->end();
        }
        
        $this->render('//common/search');
    }

}