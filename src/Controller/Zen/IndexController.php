<?php
namespace App\Controller\Zen;
use App\Controller\Zen\AppController;

class IndexController extends AppController {

    public function index() {
        $structures = json_decode($this->structures, true);
        $managements = json_decode($this->managements, true);

        $this->set(compact('structures', 'managements'));
    }

}