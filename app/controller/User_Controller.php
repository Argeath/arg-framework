<?php
namespace App;

use System\Controller;
use Helpers\Session;

class User_Controller extends Controller
{
    /** @var Model_User $user */
    public $user = null;
    const REDIRECT_TO_LOGIN = FRONT_CONTROLLER . "/user/login";
    const REDIRECT_TO_HOME  = FRONT_CONTROLLER . "/";

    protected function before()
    {
        parent::before();

        $userId = Session::get('userId');
        if($userId) {
            $this->user = new Model_User();
            $this->user->get($userId);
        }

    }

    protected function userRequired()
    {
        if ( ! $this->user ) {
            $this->redirect( self::REDIRECT_TO_LOGIN );

            return false;
        }

        return true;
    }

    protected function userNotAllowed()
    {
        if ( $this->user != null ) {
            $this->redirect( self::REDIRECT_TO_HOME );

            return false;
        }

        return true;
    }
}