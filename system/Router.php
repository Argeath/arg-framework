<?php
namespace System;

class Router
{
    public static $routes      = [ ];
    public static $methods     = [ ];
    public static $controllers = [ ];

    public static function __callStatic( $methodName, $arguments )
    {
        $methodName = strtoupper( $methodName );
        if ( ! in_array( $methodName, [ 'GET', 'POST', 'DELETE', 'UPDATE', 'ALL' ] ) ) {
            echo "[ROUTER] Invalid method " . $methodName . ". Available: GET, POST, DELETE, UPDATE, ALL.";

            return;
        }
        $uri = '/' . $arguments[0];

        array_push( self::$methods, $methodName );
        array_push( self::$routes, $uri );
        array_push( self::$controllers, $arguments[1] );
    }

    public static function invoke( $method, $params = null )
    {
        $elements = explode( '@', $method );
        $controllerName = "App\\Controller_" . $elements[0];
        $method = "action_" . $elements[1];

        if ( ! class_exists( $controllerName ) ) {
            echo "[Routing] Class " . $controllerName . " not found.";

            return;
        }

        /** @var Controller $controller */
        $controller = new $controllerName;
        $controller->controllerName = strtolower( $elements[0] );
        $controller->actionName = strtolower( $elements[1] );
        $controller->execute( $method, $params );
    }

    public static function dispatch()
    {
        $uri = strtolower( parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH ) );
        $uri = str_replace( FRONT_CONTROLLER, "", $uri );
        $method = $_SERVER['REQUEST_METHOD'];

        if ( $uri != "/" && preg_match( "#/$#", $uri ) )
            $uri = substr( $uri, 0, -1 );

        self::$routes = str_replace( '//', '/', self::$routes );

        if ( in_array( $uri, self::$routes ) ) {
            $arrayPos = array_keys( self::$routes, $uri );
            foreach ( $arrayPos as $pos ) {
                if ( self::$methods[ $pos ] == $method || self::$methods[ $pos ] == 'ANY' ) {
                    self::invoke( self::$controllers[ $pos ] );

                    return;
                }
            }
        } else {
            $arrayPos = 0;

            $bestRoute = [
                'route'  => "",
                'splits' => 0,
                'params' => [ ]
            ];

            $uriSplits = explode( "/", $uri );
            $uriSplitsCount = count( $uriSplits );

            foreach ( self::$routes as $route ) {
                $route = strtolower( str_replace( '//', '/', $route ) );
                if ( preg_match( "#/$#", $route ) ) {
                    $route = substr( $route, 0, -1 );
                }

                $routeSplits = explode( "/", $route );
                $routeSplitsCount = count( $routeSplits );

                $matcher = 0;
                $params = [ ];

                if ( ( self::$methods[ $arrayPos ] == $method || self::$methods[ $arrayPos ] == 'ALL' ) && $routeSplits[0] === $uriSplits[0] ) {
                    $matcher++;
                    for ( $i = 1; $i < $routeSplitsCount; $i++ ) {
                        if ( isset($uriSplits[$i]) && $routeSplits[ $i ] === $uriSplits[ $i ] )
                            $matcher++;
                        elseif ( preg_match( "#{+(.*?)}#", $routeSplits[ $i ], $arr ) ) {
                            $matcher++;
                            $params[] = (isset($uriSplits[$i])) ? $uriSplits[$i] : null;
                        }
                    }

                    if ( $matcher > $bestRoute['splits'] ) {
                        $bestRoute['route'] = $route;
                        $bestRoute['method'] = self::$controllers[$arrayPos];
                        $bestRoute['splits'] = $matcher;
                        $bestRoute['params'] = $params;
                    }
                }
                $arrayPos++;
            }

            if ( $bestRoute['splits'] > 0 ) {
                self::invoke( $bestRoute['method'], $bestRoute['params'] );

                return;
            }
        }

        echo "ERROR 404. Route (" . $uri . ") not found.";
    }
}