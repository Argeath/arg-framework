<?php
namespace App;

use Helpers\Database;
use Helpers\Hash;
use Helpers\Session;
use Helpers\Validation_Exception;
use System\Model;

class Model_User extends Model
{
    public function __construct()
    {
        parent::__construct();
        self::$table = "users";
        $this->fields = [
            '_id'      => 0,
            'username' => null,
            'email'    => null,
            'password' => null
        ];
    }

    public static function validate( $data, $isLogin = false )
    {
        $table = self::$table;

        if ( isset( $data['username'] ) && ! empty( $data['username'] ) ) {
            if ( ! $isLogin && strlen( $data['username'] ) < 3 )
                throw new Validation_Exception( 'Login', 2, 3 );
            else if ( ! $isLogin && strlen( $data['username'] ) > 20 )
                throw new Validation_Exception( 'Login', 3, 20 );

            if ( ! preg_match( '#[0-9a-zA-Z\s-]+#', $data['username'] ) )
                throw new Validation_Exception( 'Login', 6 );

            $duplicate = Database::getDB()->users->findOne( [ 'username' => $data['username'] ] );
            if ( $duplicate && ! $isLogin )
                throw new Validation_Exception( "Login", 8 );

        } else {
            throw new Validation_Exception( 'Login', 1 );
        }

        if ( ! $isLogin ) {
            if ( isset( $data['email'] ) && ! empty( $data['email'] ) ) {
                if ( ! filter_var( $data['email'], FILTER_VALIDATE_EMAIL ) )
                    throw new Validation_Exception( 'Email', 5 );

                $duplicate = Database::getDB()->users->findOne( [ 'email' => $data['email'] ] );
                if ( $duplicate && ! $isLogin )
                    throw new Validation_Exception( "Email", 8 );

            } else {
                throw new Validation_Exception( 'Email', 1 );
            }
        }

        if ( isset( $data['password'] ) && ! empty( $data['password'] ) ) {
            if ( ! $isLogin && strlen( $data['password'] ) < 3 )
                throw new Validation_Exception( 'Hasło', 2, 3 );
            else if ( ! $isLogin && strlen( $data['password'] ) > 20 )
                throw new Validation_Exception( 'Hasło', 3, 20 );

        } else {
            throw new Validation_Exception( 'Hasło', 1 );
        }

        if ( ! $isLogin ) {
            if ( isset( $data['repeat_password'] ) && ! empty( $data['repeat_password'] ) ) {
                if ( $data['repeat_password'] !== $data['password'] )
                    throw new Validation_Exception( 'Powtórz hasło', 4 );

            } else {
                throw new Validation_Exception( 'Powtórz hasło', 1 );
            }
        }

        return true;
    }

    public static function register( $username, $email, $password )
    {
        $user = new Model_User();

        $user->username = $username;
        $user->email = $email;
        $user->password = Hash::hash( $password );

        $user->save();
    }

    public function login( $username, $password )
    {
        $table = self::$table;

        $found = $this->db->$table->findOne( [ 'username' => $username, 'password' => Hash::hash( $password ) ] );

        if ( ! $found )
            throw new Validation_Exception( "Login/Hasło", 7 );

        Session::set( 'userId', $found['_id'] );
        $this->get( $found['_id'] );
    }
}