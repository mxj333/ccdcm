<?php
namespace App\Controller\Zen;

use App\Controller\Zen\AppController;
use Cake\Event\Event;

class UsersController extends AppController {

    public $components = ['Cookie'];

    public function initialize() {
        parent::initialize();
        // use \Cake\Core\Exception\Exception;

        //是否已经登录
        // if ($this->Auth->user()) {
        // return $this->redirect($this->Auth->redirectUrl());
        // }

    }

    public function beforeFilter(\Cake\Event\Event $event) {
        // $this->Crud->mapAction('login', 'CrudUsers.Login');
        parent::beforeFilter($event);
        $this->Auth->allow(['add', 'logout']);
    }

    public function index() {

        $this->Crud->on('beforePaginate', function (\Cake\Event\Event $event) {
            $this->paginate['conditions']['active'] = 0;
        });

        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['password', 'active', 'created', 'modified']);

        return $this->Crud->execute();
    }

    public function add() {

        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['department_id']);

        return $this->Crud->execute();
    }

    public function edit() {

        $action = $this->Crud->action();

        //不显示的字段
        $action->config('scaffold.fields_blacklist', ['department_id']);

        return $this->Crud->execute();
    }
/*
public function login() {

//布局设置
$this->viewBuilder()->layout('ajax');

if ($this->request->is('post')) {
$user = $this->Auth->identify();
var_dump($user);exit;
if ($user) {
$this->Auth->setUser($user);

//设置cookie
$this->_setCookie();
return $this->redirect($this->Auth->redirectUrl());
} else {
// $this->Cookie->delete('RememberMe');
$this->Flash->error(__('Username or password is incorrect'), [
'key' => 'auth',
]);
}
}

//自动登录
if (empty($this->data)) {
$cookie = $this->Cookie->read('RememberMe');
$this->request->data = $cookie;
if (!is_null($cookie)) {
$user = $this->Auth->identify();
if ($user) {
$this->Auth->setUser($user);
$this->redirect($this->Auth->redirectUrl());
} else {
$this->Cookie->destroy('RememberMe');
$this->Session->setFlash('Invalid cookie');
// $this->redirect('login');
}
}
}
}
 */
    public function login() {
        //布局设置
        $this->viewBuilder()->layout('ajax');
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        // $this->Crud->mapAction('logout', 'CrudUsers.Logout');
        $this->Cookie->delete('RememberMe');
        return $this->redirect($this->Auth->logout());
    }

    //设置Cookie
    protected function _setCookie() {
        if (!$this->request->data('remember_me')) {
            return false;
        }
        $data = [
            'username' => $this->request->data('username'),
            'password' => $this->request->data('password'),
        ];
        $this->Cookie->write('RememberMe', $data, true, '+1 week');
        unset($this->request->data['remember_me']);
        return true;
    }

}
