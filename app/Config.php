<?php
namespace App;

class Config
{
    public static function init()
    {
        ob_start();

        define( 'DIR', '/' );
        define( 'DEFAULT_CONTROLLER', 'welcome' );
        define( 'DEFAULT_METHOD', 'index' );

        define( 'DB_HOST', 'localhost:27017' );
        define( 'DB_USER', 'wai_web' );
        define( 'DB_PASS', 'w@i_w3b' );
        define( 'DB_NAME', 'wai' );

        define( 'SESSION_PREFIX', 'smvc_' );

        define( 'FRONT_CONTROLLER', '/index.php' );

        date_default_timezone_set( 'Europe/Warsaw' );

    }
}