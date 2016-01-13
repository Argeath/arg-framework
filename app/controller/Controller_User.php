<?php
namespace App;

use Helpers\Session;
use Helpers\Validation_Exception;
use System\View;

class Controller_User extends Layout_Controller
{
    public function action_login()
    {
        if ( ! $this->userNotAllowed() )
            return;

        $this->content = new View( "user/login" );
    }

    public function action_postLogin()
    {
        if ( ! $this->userNotAllowed() )
            return;

        try {
            Model_User::validate( $_POST, true );

            $user = new Model_User();
            $user->login($_POST['username'], $_POST['password']);

            Session::set('message', "Zostałeś zalogowany.");
            $this->redirect( FRONT_CONTROLLER . '/' );

        } catch(Validation_Exception $exception) {
            $this->content = new View( "user/login" );
            $this->content->passData( 'errorField', $exception->field );
            $this->content->passData( 'error', $exception->error );
        }
    }

    public function action_register()
    {
        if ( ! $this->userNotAllowed() )
            return;

        $this->content = new View( "user/register" );
    }

    public function action_postRegister()
    {
        if ( ! $this->userNotAllowed() )
            return;

        try {
            Model_User::validate( $_POST );

            Model_User::register( $_POST['username'], $_POST['email'], $_POST['password'] );

            Session::set('message', "Rejestracja przebiegła pomyślnie. Możesz się teraz zalogować.");

            $this->redirect( FRONT_CONTROLLER . '/user/login' );

        } catch (Validation_Exception $exception) {
            $this->content = new View( "user/register" );
            $this->content->passData( 'errorField', $exception->field );
            $this->content->passData( 'error', $exception->error );
        }
    }

    public function action_logout()
    {
        if ( ! $this->userRequired() )
            return;

        Session::destroy();

        $this->redirect( FRONT_CONTROLLER . '/user/login' );
    }
}