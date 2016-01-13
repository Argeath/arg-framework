<?php
namespace System;

abstract class Controller
{
    public $view;
    public $controllerName;
    public $actionName;

    public function __construct()
    {
        $this->view = new View();
    }

    protected function before() { }

    protected function after() { }

    public function execute( $function, $params )
    {
        if ( ! method_exists( $this, $function ) ) {
            echo "[Routing] Class method " . $function . " not found.";

            return;
        }
        $this->before();
        call_user_func_array( [ $this, $function ], $params ? $params : [ ] );
        $this->after();
    }

    protected function redirect($path) {
        $this->view->addHeader("Location: ".$path);
    }
}