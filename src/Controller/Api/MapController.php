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
class MapController extends AppController {
    /**
     * @desc Create.
     *
     * @param string $name
     * @param int backgroundid
     *
     * @return array
     */
    public function create() {
        $_params = $this->request->data;

        // $_params['name'] = 'Map-'.rand(20, 9999);
        // $_params['backgroundid'] = '188';
        if (empty($_params['name'])) {
            echo __('Name Not Empty');
            exit;
        }

        // $_params = $this->request->data;

        $default = array(
            'width' => '800',
            'height' => '600',
        );
        $params = array_merge($default, $_params);
        $data = $this->api->mapCreate($params);
        $this->returnData($data);
    }

    /**
     * @desc get.
     *
     * @param int $sysmapids
     *
     * @return array
     */
    public function get() {
        $_params = $this->request->data;
        // $_params['sysmapids'] = 4;
        if (!(int) ($_params['sysmapids'])) {
            echo __('sysmapids Not Empty');
            exit;
        }

        $default = array(
            'output' => 'extend',
            'selectSelements' => 'extend',
            'selectLinks' => 'extend',
            'selectUsers' => 'extend',
            'selectUserGroups' => 'extend',
        );
        $params = array_merge($default, $_params);

        $data = $this->api->mapGet($params);
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
        $params = $this->request->data;
        // $params['sysmapid'] = 4;
        if (!(int) ($params['sysmapid'])) {
            echo __('sysmapids Not Empty');
            exit;
        }
        // $params['name'] = 'Map-up-'.rand(20, 9999);
        $data = $this->api->mapUpdate($params);
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
        $params['sysmapids'] = 4; //array(20);
        if (empty($params['sysmapids'])) {
            echo __('sysmapids Not Empty');
            exit;
        }
        if (!is_array($params['sysmapids'])) {
            $params['sysmapids'] = array((int) ($params['sysmapids']));
        }

        $data = $this->api->mapDelete($params['sysmapids']);
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
        // $order = isset($params['order']) ? $params['order'] : 'usrgrpid asc';
        // $current_page = isset($params['current_page']) ? (int) ($params['current_page']) : 1;
        // $not_page = isset($params['not_page']) ? $params['not_page'] : false;
        // $limit = isset($params['limit']) ? $params['limit'] : 20;

        $cofigs = array(
            'where' => array(),
            'field_name' => '*',
            'order' => array('sysmapid' => 'DESC'),
            'limit' => 2,
            'page' => 1,
        );
        $results = $this->getPage('sysmaps', $cofigs);
        // pr($results);
        exit;
        $this->returnData($results);
    }
}
