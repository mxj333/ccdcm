<?php
namespace App\Controller\Api;

use App\Controller\Api\AppController;

class IndexController extends AppController {

    public function initialize() {
        parent::initialize();

    }

    /**
     * beforeFilter callback.
     *
     * @param \Cake\Event\Event $event Event.
     * @return \Cake\Network\Response|null|void
     */
    public function index() {

    }

}
