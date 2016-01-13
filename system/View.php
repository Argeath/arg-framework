<?php

namespace System;

class View
{
    public $name;
    public $data = [ ];
    private static $headers = [ ];

    public function __construct( $name = "" )
    {
        $this->name = $name;
    }

    public function render()
    {
        if(! $this->name)
            return;

        if ( ! headers_sent() )
            foreach ( self::$headers as $header )
                header( $header, true );

        extract( $this->data );
        require "./app/views/" . $this->name . ".php";
    }

    public function passData( $key, $value )
    {
        $this->data[ $key ] = &$value;
    }

    public static function addHeader( $header )
    {
        self::$headers[] = $header;
    }

    public static function addHeaders( $headers = [ ] )
    {
        foreach ( $headers as $header ) {
            self::addHeader( $header );
        }
    }
}