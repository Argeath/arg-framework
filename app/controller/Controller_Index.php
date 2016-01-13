<?php
namespace App;

use System\View;

class Controller_Index extends Layout_Controller
{
    public function action_index()
    {
        $this->content = new View( "pages/index" );
    }

    public function action_airforces()
    {
        $this->content = new View( "pages/airforces" );
    }

    public function action_ankieta()
    {
        $this->content = new View( "pages/ankieta" );
    }

    public function action_ksiegaGosci()
    {
        $this->content = new View( "pages/ksiegaGosci" );
    }
}