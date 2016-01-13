<?php
namespace Helpers;

class Session
{
    private static $sessionStarted = false;

    public static function init()
    {
        if ( ! self::$sessionStarted ) {
            session_start();
            self::$sessionStarted = true;
        }
    }

    public static function set( $key, $value )
    {
        $_SESSION[ $key ] = $value;
    }

    public static function get( $key, $default = null )
    {
        if ( isset( $_SESSION[ $key ] ) )
            return $_SESSION[ $key ];

        return $default;
    }

    public static function getId()
    {
        return session_id();
    }

    public static function regenerateId()
    {
        session_regenerate_id( true );

        return session_id();
    }

    public static function destroy()
    {
        if ( self::$sessionStarted ) {
            session_unset();
            session_destroy();
            $params = session_get_cookie_params();
            setcookie( session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"] );
            self::$sessionStarted = false;
        }
    }
}