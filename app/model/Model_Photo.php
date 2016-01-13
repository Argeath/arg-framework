<?php
namespace App;

use Helpers\Hash;
use Helpers\Photo;
use Helpers\Validation_Exception;
use System\Model;

class Model_Photo extends Model
{
    public function __construct()
    {
        parent::__construct();
        self::$table = "photos";
        $this->fields = [
            '_id'       => 0,
            'title'     => null,
            'autor'     => null,
            'autorUser' => null,
            'tryb'      => 'public',
            'photoPath' => null,
            'smallPath' => null,
            'bigPath'   => null
        ];
    }

    public static function validate( $data, $files, $userLogged = null )
    {
        $table = self::$table;

        if ( isset( $data['title'] ) && ! empty( $data['title'] ) ) {
            if ( strlen( $data['title'] ) < 3 )
                throw new Validation_Exception( 'Tytuł', 2, 3 );
            else if ( strlen( $data['title'] ) > 20 )
                throw new Validation_Exception( 'Tytuł', 3, 20 );

            if ( ! preg_match( '#[0-9a-zA-Z\s-]+#', $data['title'] ) )
                throw new Validation_Exception( 'Tytuł', 6 );

        } else {
            throw new Validation_Exception( 'Tytuł', 1 );
        }

        if ( isset( $data['autorUser'] ) ) {
            $user = new Model_User();
            $user->get( $data['autorUser'] );

            if ( ! $user->loaded )
                throw new Validation_Exception( "Autor", 9 );
            else if ( $user->_id->{'$id'} !== $userLogged->_id->{'$id'} )
                throw new Validation_Exception( "Autor", 9 );

        } else {
            if ( isset( $data['autor'] ) && ! empty( $data['autor'] ) ) {
                if ( strlen( $data['autor'] ) < 3 )
                    throw new Validation_Exception( 'Autor', 2, 3 );
                else if ( strlen( $data['autor'] ) > 20 )
                    throw new Validation_Exception( 'Autor', 3, 20 );

                if ( ! preg_match( '#[0-9a-zA-Z\s-]+#', $data['autor'] ) )
                    throw new Validation_Exception( 'Autor', 6 );

            } else {
                throw new Validation_Exception( 'Autor', 1 );
            }
        }
        if(empty($files["file"]["tmp_name"]))
            throw new Validation_Exception( 'Zdjęcie', 10 );

        $targetFile = basename( $files["file"]["name"] );
        $fileType = pathinfo( $targetFile, PATHINFO_EXTENSION );

        $check = getimagesize( $files["file"]["tmp_name"] );
        if ( $check !== false ) {
            $mime = $check["mime"];

            if ( $files["file"]["size"] > 1000000 )
                throw new Validation_Exception( 'Zdjęcie', 11, '1MB' );

            if ( ! preg_match( '/jpg|jpeg|png/', $fileType ) )
                throw new Validation_Exception( 'Zdjęcie', 12, "JPG, PNG" );
        } else {
            throw new Validation_Exception( 'Zdjęcie', 10 );
        }

        return true;
    }

    public function add( $data, $files )
    {
        $table = self::$table;

        $this->title = $data['title'];

        if ( isset( $data['autorUser'] ) ) {
            $this->autorUser = $data['autorUser'];
            $this->tryb = ( $data['tryb'] == 'private' ) ? 'private' : 'public';
        } else
            $this->autor = $data['autor'];

        $fileExtension = pathinfo( basename( $files["file"]["name"] ), PATHINFO_EXTENSION );
        $targetName = Hash::hash( rand( 1, 9999999 ) . "" . Hash::hash( rand( 1, 9999999 ) ) ) . "." . $fileExtension;
        $targetPath = SITE_ROOT . "/assets/uploads/" . $targetName;

        if(! move_uploaded_file($files["file"]["tmp_name"], $targetPath))
            throw new Validation_Exception('Zdjęcie', 13);

        $this->photoPath = $targetName;

        $waterMarkName = Hash::hash( rand( 1, 9999999 ) . "" . Hash::hash( rand( 1, 9999999 ) ) ) . ".jpg";
        $waterMarkPath = SITE_ROOT . "/assets/uploads/" . $waterMarkName;
        Photo::addWaterMarkText($targetPath, $waterMarkPath, "TEST");

        $this->bigPath = $waterMarkName;

        $thumbName = Hash::hash( rand( 1, 9999999 ) . "" . Hash::hash( rand( 1, 9999999 ) ) ) . ".jpg";
        $thumbPath = SITE_ROOT . "/assets/uploads/" . $thumbName;
        Photo::createThumbnail($targetPath, $thumbPath);

        $this->smallPath = $thumbName;

        $this->save();
    }
}