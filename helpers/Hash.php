<?php
namespace Helpers;


class Hash
{
    public static $method = "sha1";


    public static function hash($str)
    {
        return hash(self::$method, $str);
    }
}