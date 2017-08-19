<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller\Api;

/**
 * Static content controller.
 *
 * This controller will render views from Template/Pages/
 *
 * @see http://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UserController extends AppController {
    public function initialize() {
        parent::initialize();
    }

    /**
     * @desc 列表
     *
     * @param string $order
     * @param string $current_page
     * @param bool   $not_page
     *
     * @return array
     */
    public function lists() {
        $params = $this->request->data;
        $order = isset($params['order']) ? $params['order'] : 'userid asc';
        $current_page = isset($params['current_page']) ? (int) ($params['current_page']) : 1;
        $not_page = isset($params['not_page']) ? $params['not_page'] : false;
        $limit = isset($params['limit']) ? $params['limit'] : 20;

        $results = $this->getListByPage('select users.userid, users.alias, users.`name`, users.surname, users.url,
        users.autologin, users.autologout, users.lang, users.refresh, users.type, users.theme, users.attempt_failed,
        users.attempt_ip, users.attempt_clock, users.rows_per_page  from `users` ', $order, $current_page, $not_page, $limit);
        $this->set(compact('results'));
        $this->set('_serialize', array('results'));
    }

    /**
     * @desc Create user.
     *

     * @param string $name
     * @param string $surname
     * @param array  $alias
     * @param string $passwd
     * @param string $usrgrps
     * @param string $lang
     * @param int    $refresh
     * @param int    $type
     *
     * @return array
     */
    public function create() {
        $_params = $this->request->data;
        // pr($_params);
        // exit;
        $default = array(
            'name' => 'test',
            'surname' => 'test',
            'alias' => 'test-'.rand(20, 9999),
            'passwd' => '123456',
            'url' => '',
            'autologin' => '1',
            'autologout' => '0',
            'usrgrps' => array('7'),
            'lang' => 'en_US',
            'refresh' => '30',
            'type' => '1',
            'theme' => 'default',
            'attempt_failed' => 0,
            'attempt_ip' => 0,
            'attempt_clock' => 0,
            'rows_per_page' => 50,
        );

        $params = array_merge($default, $_params);
        $usrgrps = $params['usrgrps'];
        unset($params['usrgrps']);
        if (trim($params['passwd'])) {
            $params['passwd'] = md5(trim($params['passwd']));
        }

        $userid = $this->save('users', 'userid', $params);

        if ($userid) {
            foreach ($usrgrps as $groupid) {
                $users_groups['usrgrpid'] = $groupid;
                $users_groups['userid'] = $userid;
                $data = $this->save('users_groups', 'id', $users_groups);
            }
        }
        $this->returnData($userid);
        // exit;
    }

    /**
     * @desc Update user.
     *
     * @param array  $users
     * @param string $users['userid']
     * @param string $users['name']
     * @param string $users['surname']
     * @param array  $users['alias']
     * @param string $users['passwd']
     * @param string $users['url']
     * @param int    $users['autologin']
     * @param int    $users['autologout']
     * @param string $users['lang']
     * @param string $users['theme']
     * @param int    $users['refresh']
     * @param int    $users['rows_per_page']
     * @param int    $users['type']
     * @param array  $users['user_medias']
     * @param string $users['user_medias']['mediatypeid']
     * @param string $users['user_medias']['address']
     * @param int    $users['user_medias']['severity']
     * @param int    $users['user_medias']['active']
     * @param string $users['user_medias']['period']
     *
     * @return array
     */
    public function update() {
        $params = $this->request->data;

        $params = array(
            'userid' => 10,
            'name' => 'test-id10',
            'passwd' => '123456',
            'usrgrps' => array('19', '20'),
        );

        if (!(int) ($params['userid'])) {
            echo __('Userid Not Empty');
            exit;
        }

        if (!empty($params['passwd'])) {
            $params['passwd'] = md5(trim($params['passwd']));
        }

        $usrgrps = $params['usrgrps'];
        unset($params['usrgrps']);

        $userid = $this->save('users', 'userid', $params);

        if ($userid && !empty($usrgrps)) {
            $this->del('users_groups', 'userid', $userid);
            foreach ($usrgrps as $groupid) {
                $users_groups['usrgrpid'] = $groupid;
                $users_groups['userid'] = $userid;
                $data = $this->save('users_groups', 'id', $users_groups);
            }
        }
        $this->returnData($userid);
    }

    /**
     * @desc Delete user.
     *
     * @param array $userids
     *
     * @return array
     */
    public function delete() {
        $params = $this->request->data;
        // $params['userids'] = array(30);
        if (empty($params['userids'])) {
            echo __('Userids Not Empty');
            exit;
        }
        if (!is_array($params['userids'])) {
            $params['userids'] = array((int) ($params['userids']));
        }
        $data = $this->api->userDelete($params['userids']);
        $this->returnData($data);
    }

    /**
     * @desc Get users data.
     *
     * @param array  $options
     * @param array  $options['usrgrpids']     filter by UserGroup IDs
     * @param array  $options['userids']       filter by User IDs
     * @param bool   $options['type']          filter by User type
     * @param bool   $options['selectUsrgrps'] extend with UserGroups data for
     * @param bool   $options['getAccess']     extend with access data for each
     * @param bool   $options['count']         output only count of objects in
     * @param string $options['pattern']       filter by Host name containing
     * @param int    $options['limit']         output will be limited to given
     * @param string $options['sortfield']     output will be sorted by given
     * @param string $options['sortorder']     output will be sorted in given
     *
     * @return array
     */
    public function get() {
        $params = $this->request->data;

        if ($params['userids'] === null) {
            echo __('Userids Not Empty');
            exit;
        }
        //pr($params);//exit;
        $data = $this->api->userGet($params);
        $this->returnData($data);
    }

    /**
     * @desc Login user.
     *
     * @param array $user     User alias
     * @param array $password User password
     * @param bool  $userData
     *
     * @return string session id
     */
    public function login() {
        $params = $this->request->data;

        $params = array(
              'user' => 'admin',
              'password' => 'admin',
              'userData' => true,
          );

        if (!isset($params['user']) || !isset($params['password'])) {
            echo __('User OR Password Not Empty');
            exit;
        }

        $data = $this->api->userLogin($params, '', TMP);
        $this->returnData($data);
    }

    /**
     * @desc 退出
     *
     * @return bool
     */
    public function logout() {
        $params = $this->request->data;
        // pr($params);exit;
        $data = $this->api->userLogout($params);
        $this->returnData($data);
    }

    /**
     * @desc 获取接口数据缓存到redis
     */
    public function getUserList() {
        $params = $this->request->data;
        //pr($params);exit;
        $page = isset($params['page']) ? $params['page'] : 1;
        $size = isset($params['size']) ? $params['size'] : 15;
        $data = array();

        //缓存数据
        $key = 'user';
        if (!redisKeyExists($key)) {
            $this->getListToService($key);
        }

        $data = getPageData($key, $page, $size);

        $this->set(compact('data'));
        $this->set('_serialize', array('data'));
    }
}
