<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

/**
 * Users Controller.
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController {
    public function login() {
    }

    /**
     * Index method.
     *
     * @return \Cake\Http\Response|void
     */
    public function index() {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
        $this->set('_serialize', array('users'));
    }

    /**
     * View method.
     *
     * @param string|null $id user id
     *
     * @return \Cake\Http\Response|void
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException when record not found
     */
    public function view($id = null) {
        $user = $this->Users->get($id, array(
            'contain' => array(),
        ));

        $this->set('user', $user);
        $this->set('_serialize', array('user'));
    }

     /**
      * Add method.
      *
      * @return \Cake\Http\Response|null redirects on successful add, renders view otherwise
      */
     public function add() {
         $default = array(
             'alias' => 'mxj-'.rand(20, 9999),
             'passwd' => '123456',
         );
        //  pr($default);
         $config = array(
           'method' => 'User.create',
           'params' => $default,
         );

         $res = api($config);
         pr($res);
         exit();
     }

    /**
     * Edit method.
     *
     * @param string|null $id user id
     *
     * @return \Cake\Http\Response|null redirects on successful edit, renders view otherwise
     *
     * @throws \Cake\Network\Exception\NotFoundException when record not found
     */
    public function edit($id = null) {
        $user = $this->Users->get($id, array(
            'contain' => array(),
        ));
        if ($this->request->is(array('patch', 'post', 'put'))) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', array('user'));
    }

    /**
     * Delete method.
     *
     * @param string|null $id user id
     *
     * @return \Cake\Http\Response|null redirects to index
     *
     * @throws \Cake\Datasource\Exception\RecordNotFoundException when record not found
     */
    public function delete($id = null) {
        $this->request->allowMethod(array('post', 'delete'));
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(array('action' => 'index'));
    }
}
