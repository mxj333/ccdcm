<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller\Api;

class AuditlogsController extends AppController {
    public function initialize() {
        parent::initialize();
    }

    /**
     * beforeFilter callback.
     *
     * @param \Cake\Event\Event $event event
     *
     * @return \Cake\Network\Response|null|void
     */
    public function index() {
        $params = $this->request->data;
        $order = $params['order'] ? $params['order'] : '';
        $current_page = $params['current_page'] ? $params['current_page'] : 1;
        $results = $this->getListByPage('select * from `auditlog`', 'auditid desc', $order, $current_page);
        $this->set(compact('results'));
        $this->set('_serialize', array('results'));
    }
}
