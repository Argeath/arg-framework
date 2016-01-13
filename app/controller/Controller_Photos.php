<?php
namespace App;

use Helpers\Session;
use Helpers\Validation_Exception;
use System\View;

class Controller_Photos extends Layout_Controller
{
    public function action_index() {
        $this->content = new View("photos/photos");

        $photos = new Model_Photo();
        $allPhotos = [];
        foreach($photos->getAll() as $photo) {
            $p = new Model_Photo();
            $p->get($photo['_id']);

            if($p->loaded && isset($p->bigPath) && isset($p->smallPath) && file_exists("assets/uploads/".$p->bigPath) && file_exists("assets/uploads/".$p->smallPath)) {
                if(isset($p->autorUser)) {
                    $autor = new Model_User();
                    $autor->get($p->autorUser);
                    $p->autor = $autor->username;

                    if($p->tryb == "private" && ( ! $this->user || $autor->username != $this->user->username))
                        continue;
                }

                $p->isRemembered = Session::get("remember_photo_".$p->_id->{'$id'}, false);
                $allPhotos[] = $p;
            }
        }

        $this->content->passData('photos', $allPhotos);
    }

    public function action_rememberedPhotos() {
        $this->content = new View("photos/remembered");

        $photos = new Model_Photo();
        $allPhotos = [];
        foreach($photos->getAll() as $photo) {
            $p = new Model_Photo();
            $p->get($photo['_id']);

            if($p->loaded && isset($p->bigPath) && isset($p->smallPath) && file_exists("assets/uploads/".$p->bigPath) && file_exists("assets/uploads/".$p->smallPath)) {
                if(isset($p->autorUser)) {
                    $autor = new Model_User();
                    $autor->get($p->autorUser);
                    $p->autor = $autor->username;

                    if($p->tryb == "private" && ( ! $this->user || $autor->username != $this->user->username))
                        continue;
                }

                if(Session::get("remember_photo_".$p->_id->{'$id'}, false))
                    $allPhotos[] = $p;
            }
        }

        $this->content->passData('photos', $allPhotos);
    }

    public function action_searchPhotos() {
        $this->content = new View("photos/search");
    }

    public function action_addPhoto() {
        $this->content = new View("photos/addPhoto");
        $this->content->passData( 'user', $this->user );
        $this->content->passData( 'isLogged', $this->user != null );

    }

    public function action_postAddPhoto() {
        $targetDir = "/assets/uploads/";

        try {
            Model_Photo::validate($_POST, $_FILES, $this->user);
            $target_file = $targetDir . basename( $_FILES["file"]["name"] );

            $photo = new Model_Photo();
            $photo->add($_POST, $_FILES);

            Session::set('message', "Zdjęcie zostało dodane.");

            $this->redirect("/index.php/photos");

        } catch(Validation_Exception $exception) {
            $this->content = new View( "photos/addPhoto" );
            $this->content->passData( 'user', $this->user );
            $this->content->passData( 'isLogged', $this->user != null );
            $this->content->passData( 'errorField', $exception->field );
            $this->content->passData( 'error', $exception->error );
        }
    }

    public function action_postRememberPhotos() {
        foreach($_SESSION as $session => $key) {
            if(preg_match("#^remember_photo_#", $session)) {
                Session::set($session, false);
            }
        }
        foreach($_POST as $post => $value) {
            if(preg_match("#^remember_photo_#", $post)) {
                Session::set($post, $value == 'Y');
            }
        }
        $this->redirect("/index.php/photos");
    }

    public function action_postForgetPhotos() {
        foreach($_POST as $post => $value) {
            if(preg_match("#^remember_photo_#", $post)) {
                Session::set($post, false);
            }
        }
        $this->redirect("/index.php/photos/remembered");
    }
}