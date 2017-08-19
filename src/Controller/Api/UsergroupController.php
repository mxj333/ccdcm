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
 * Users Controller.
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsergroupController extends AppController {
    /**
     * @desc Create.
     *
     * @param string $name
     *
     * @return array
     */
    public function create() {
        $params = $this->request->data;
        // pr($params);exit;
        // $params['name'] = 'group-'.rand(20, 9999);
        if (empty($params['name'])) {
            echo __('Name Not Empty');
            exit;
        }

        $data = $this->api->usergroupCreate($params);
        $this->returnData($data);
    }

    /**
     * @desc get.
     *
     * @param array $usrgrpids
     *
     * @return array
     */
    public function get() {
        $params['editable'] = true;
        if ($params['usrgrpid'] === null) {
            echo __('usrgrpid Not Empty');
            exit;
        }
        $params = $this->request->data;

        $data = $this->api->usergroupGet($params);
        $this->returnData($data);
    }

    /**
     * @desc update.
     *
     * @param array  $usrgrpid
     * @param string $name
     * @param int    $users_status
     *
     * @return array
     */
    public function update() {
        $params['editable'] = true;
        $params = $this->request->data;
        // var_dump($params);die;
        if ($params['usrgrpid'] === null) {
            echo __('usrgrpid Not Empty');
            exit;
        }

        $data = $this->api->usergroupUpdate($params);
        $this->returnData($data);
    }

    /**
     * @desc delete.
     *
     * @param array $usrgrpid
     *
     * @return array
     */
    public function delete() {
        $params = $this->request->data;
        // $params['usrgrpids'] = array(20);
        if (empty($params['usrgrpids'])) {
            echo __('usrgrpids Not Empty');
            exit;
        }
        if (!is_array($params['usrgrpids'])) {
            echo __('usrgrpids Not an Array');
            exit;
        }
        $data = $this->api->usergroupDelete($params['usrgrpids']);
        $this->returnData($data);
    }

    /**
     * @desc 列表
     *
     * @param string $order
     * @param string $current_page
     * @param bool   $not_page
     * @param int    $limit
     *
     * @return array
     */
    public function lists() {
        $params = $this->request->data;
        $order = isset($params['order']) ? $params['order'] : 'usrgrpid asc';
        $current_page = isset($params['current_page']) ? (int) ($params['current_page']) : 1;
        $not_page = isset($params['not_page']) ? $params['not_page'] : false;
        $limit = isset($params['limit']) ? $params['limit'] : 20;

        $results = $this->getListByPage('select usrgrp.usrgrpid, usrgrp.`name`, usrgrp.gui_access, usrgrp.users_status, usrgrp.debug_mode  from `usrgrp` ', $order, $current_page, $not_page, $limit);
        $this->returnData($results);
    }

    /**
     * @desc 获取接口数据缓存到redis
     */
    public function getUsergroupList() {
        $params = $this->request->data;
        //pr($params);exit;
        $page = isset($params['page']) ? $params['page'] : 1;
        $size = isset($params['size']) ? $params['size'] : 15;
        $data = array();

        //缓存数据
        $key = 'usergroup';
        if (!redisKeyExists($key)) {
            $this->getListToService($key);
        }

        $data = getPageData($key, $page, $size);
        // var_dump($data);die;
        $this->set(compact('data'));
        $this->set('_serialize', array('data'));
    }
}
