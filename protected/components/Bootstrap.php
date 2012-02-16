<?php

class Bootstrap
{

    public static function beginRequest()
    {
        if (!guest())
        {
            $logged_in = User::model()->findByPk(u()->id, array('select' => 'logged_in'))->logged_in;
            if (!$logged_in)
            {
                u()->logout();
            }
            a()->language = u()->language;
        }
    }

}