<?php

namespace Helpers;

class Database
{
    protected static $db;

    protected function __construct()
    {
        $mongo = new \MongoClient(
            "mongodb://" . DB_HOST . "/",
            [
                'username' => DB_USER,
                'password' => DB_PASS,
                'db'       => DB_NAME
            ] );

        Database::$db = $mongo->{DB_NAME};
    }

    public static function getDB()
    {
        if ( ! self::$db ) {
            new Database();
        }

        return self::$db;
    }
}