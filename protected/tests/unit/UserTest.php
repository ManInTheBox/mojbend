<?php

/**
 * Used for unit testing
 *
 * @author Zarko Stankovic <stankovic.zarko@gmail.com>
 */
class UserTest extends CDbTestCase
{
    public $fixtures = array(
        'users' => 'User',
    );
    
    public function testEncryptPassword()
    {
        $user = $this->users('user1');
        $this->assertEquals(User::encryptPassword('pera123'), $user->password);
    }
    
    public function testAuthenticate()
    {
        $user = $this->users('user1');
        $identity = new UserIdentity($user->username, 'pera123');
        
        $this->assertTrue($identity->authenticate());
    }
        
}