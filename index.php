<?php

error_reporting(E_ALL);

if (file_exists('./vendor/autoload.php'))
{
    require './vendor/autoload.php';
} else {
    echo "<h1>Install via Composer. Type 'composer install' in Terminal.</h1>";
    exit;
}

if(!is_readable("./app/Config.php"))
{
    echo "<h1>No Config found. (config.php in /app)</h1>";
    exit;
}

define ('SITE_ROOT', realpath(dirname(__FILE__)));

App\Config::init();
Helpers\Session::init();

require "./app/routes.php";
System\Router::dispatch();