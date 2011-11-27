<?php

/**
 * Wrapper of {@link CWebUser} to perform some needed functionality
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class WebUser extends CWebUser
{

    protected function afterLogin($fromCookie)
    {
        $userLog = new UserLog();
        $userLog->user_id = $this->id;
        $userLog->save(false);
    }

    /**
     * This is implementation of core framework method.
     *
     * If login is cookie based, we need to compare cookie token with the one found in database.
     * If they are not the same user wont be logged in.
     *
     * @param mixed $id the user ID. This is the same as returned by {@link getId()}.
     * @param array $states a set of name-value pairs that are provided by the user identity.
     * @param boolean $fromCookie whether the login is based on cookie
     * @return boolean whether the user should be logged in
     */
    protected function beforeLogin($id, $states, $fromCookie)
    {
        $allowLogin = true;
        if ($fromCookie)
        {
            $user = User::model()->findByPk($id, array('select' => 'cookie_token')); // select only cookie_token, not all fields
            if ($user->cookie_token != $states['cookie_token'])
            {
                $allowLogin = false;
            }
        }
        return $allowLogin;
    }

    /**
     * Just set LOGGED_OUT flag in database before logging out current user.
     * @return boolean whether to log out the user. Defaults to true
     */
    protected function beforeLogout()
    {
        User::model()->updateByPk(u()->id, array('logged_in' => User::LOGGED_OUT));
        return true;
    }

}