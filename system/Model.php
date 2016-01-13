<?php
namespace System;

use Helpers\Database;

abstract class Model
{
    protected     $db        = null;
    public static $table     = null;
    protected     $savedToDB = false;
    protected     $fields    = [];
    public $loaded = false;

    public function __construct()
    {
        $this->db = Database::getDB();
    }

    public function get( $id )
    {
        $table = self::$table;
        if ( $table ) {

            if( ! is_object($id))
                $id = new \MongoId($id);

            $this->fields = $this->db->$table->findOne( [ '_id' => $id ] );

            foreach ( $this->fields as $key => $value )
                $this->$key = $value;

            $this->savedToDB = true;
            $this->loaded = true;
        }

        return null;
    }

    public function getAll()
    {
        $table = self::$table;
        if ( $table )
            return $this->db->$table->find();

        return [ ];
    }

    public function save()
    {
        $table = self::$table;

        $arr = [ ];
        foreach ( $this->fields as $key => $value )
            if ( isset( $this->$key ) )
                $arr[ $key ] = $this->$key;

        if ( ! $this->savedToDB )
            $arr['_id'] = new \MongoId();

        $this->db->$table->save( $arr );
        $this->loaded = true;
    }
}