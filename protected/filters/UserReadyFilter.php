<?php

/**
 * Description of UserReadyFilter
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class UserReadyFilter extends CFilter
{
    protected function preFilter($filterChain)
    {
        // TODO: ubaciti i url_alias proveru!
        $uid = null;

        if (isset ($_GET['uid']))
        {
            $uid = $_GET['uid'];
        }
        else if (!guest())
        {
            $uid = u()->id;
        }
        
        $user = User::model()->findByAttributes(array('id' => $uid));

        if ($user)
        {
            return true;
        }
        else
        {
            throw new CHttpException(404);
        }
    }
}