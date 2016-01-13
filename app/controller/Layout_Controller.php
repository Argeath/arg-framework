<?php
namespace App;

use Helpers\Session;
use System\View;

class Layout_Controller extends User_Controller
{
    public $content;
    public $header;
    public $menu;
    public $footer;

    protected function before()
    {
        parent::before();

        $this->view->name = "layout/layout";

        if(Session::get('message', false)) {
            $message = Session::get('message');
            $this->view->passData('message', $message);
            Session::set('message', false);
        }

        $this->header = new View( "layout/header" );
        $this->header->passData( 'user', $this->user );
        $this->header->passData( 'isLogged', $this->user != null );

        $this->menu = new View( "layout/menu" );
        $this->menu->passData( "controller", $this->controllerName );
        $this->menu->passData( "action", $this->actionName );

        $this->footer = new View( "layout/footer" );
    }

    protected function after()
    {
        parent::after();
        $this->view->passData( "header", $this->header );
        $this->view->passData( "menu", $this->menu );
        $this->view->passData( "footer", $this->footer );
        $this->view->passData( "content", $this->content );
        $this->view->render();
    }
}