<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @see http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see http://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        $this->loadComponent('Security');
        $this->loadComponent('Csrf');
    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event the beforeRender event
     *
     * @return \Cake\Network\Response|null|void
     */
    public function beforeRender(Event $event) {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), array('application/json', 'application/xml'), true)
        ) {
            $this->set('_serialize', true);
        }
    }
}
