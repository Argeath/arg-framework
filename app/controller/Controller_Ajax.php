<?php
namespace App;

use System\View;

class Controller_Ajax extends User_Controller
{
    public function action_searchPhotos($text) {
        $photos = new Model_Photo();
        $allPhotos = [];
        $this->view = new View("photos/searchPhotos");

        foreach($photos->getAll() as $photo) {
            $p = new Model_Photo();
            $p->get($photo['_id']);

            if($p->loaded && isset($p->bigPath) && isset($p->smallPath) && file_exists("assets/uploads/".$p->bigPath)
                && file_exists("assets/uploads/".$p->smallPath) && stripos(strtolower($p->title), strtolower($text)) !== false) {
                if(isset($p->autorUser)) {
                    $autor = new Model_User();
                    $autor->get($p->autorUser);
                    $p->autor = $autor->username;

                    if($p->tryb == "private" && ( ! $this->user || $autor->username != $this->user->username))
                        continue;
                }
                $allPhotos[] = $p;
            }
        }

        $this->view->passData('photos', $allPhotos);
    }

    protected function after() {
        $this->view->render();
    }
}