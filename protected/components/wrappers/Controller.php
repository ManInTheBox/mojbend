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

    public function setFlash($key, $value, $defaultValue = null)
    {
        u()->setFlash($key, $value, $defaultValue);
    }

    public function setFlashSuccess($value = NULL, $defaultValue = null)
    {
        if ($value === NULL)
        {
            $value = Message::getFlashSuccessMessage();
        }
        $this->setFlash('success', $value, $defaultValue);
    }

    public function setFlashError($value = NULL, $defaultValue = null)
    {
        if ($value === NULL)
        {
            $value = Message::getFlashErrorMessage();
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
            echo $this->getFlashSuccess();
        }
        else if ($this->hasFlashError())
        {
            echo $this->getFlashError();
        }
        else if ($this->hasFlashInfo())
        {
            echo $this->getFlashInfo();
        }
    }

}