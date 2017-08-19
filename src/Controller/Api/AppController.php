<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller\Api;

use BlinnoApi\BlinnoApi;
use Cake\Cache\Cache;
use Cake\Controller\Controller;
use Cake\Core\App;
use Cake\Datasource\ConnectionManager;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Utility\Inflector;

class AppController extends Controller {
    use \Crud\Controller\ControllerTrait;

    //默认分页设置
    public $paginate = array(
        'page' => 1,
        'limit' => 10,
        'maxLimit' => 100,
    );

    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
        // $this->loadComponent('Auth');
        // $this->loadComponent('Crud.Crud', array(
        //     'actions' => array(
        //         'Crud.Index',
        //     ),
        //     'listeners' => array(
        //         'Crud.Api',
        //         'Crud.ApiPagination',
        //         'Crud.ApiQueryLog',
        //     ),
        // ));

        require_once ROOT.DS.'vendor'.DS.'blinno'.DS.'BlinnoApi.class.php';
        $this->api = new BlinnoApi('http://127.0.0.1/ccdcm_api/api_jsonrpc.php', 'admin', 'admin');
        // $this->api = new BlinnoApi('http://123.56.130.1/zabbix/api_jsonrpc.php', 'admin', 'admin');

        ConnectionManager::config('cloudcon-api', array(
            'url' => 'mysql://root:root@localhost/zabbix?encoding=utf8&timezone=UTC&cacheMetadata=true',
        ));

        $this->connection = ConnectionManager::get('cloudcon-api');
    }

    public function apiData($config) {
        // pr($config);
        require_once ROOT.DS.'vendor'.DS.'blinno'.DS.'zbx.inc.php';
        $api = new \zbx();

        $api->url = 'http://127.0.0.1/php/api_jsonrpc.php';
        $api->method = 'user.login';
        $api->query['user'] = $config['user'];
        $api->query['password'] = $config['password'];
        $api->access_token = $api->call()['result'];
        pr($api->call());
    }

    /**
     * Get a list of controllers in the app and plugins.
     *
     * Returns an array of path => import notation.
     *
     * @param string $plugin Name of plugin to get controllers for
     * @param string $prefix Name of prefix to get controllers for
     *
     * @return array
     */
    public function getControllerList($plugin = null, $prefix = 'Api') {
        if (!$plugin) {
            $path = App::path('Controller'.(empty($prefix) ? '' : DS.Inflector::camelize($prefix)));
            $dir = new Folder($path[0]);
            $controllers = $dir->find('.*Controller\.php');
        } else {
            $path = App::path('Controller'.(empty($prefix) ? '' : DS.Inflector::camelize($prefix)), $plugin);
            $dir = new Folder($path[0]);
            $controllers = $dir->find('.*Controller\.php');
        }

        return $controllers;
    }

    /**
     *更新一组控制器。
     *
     * @param array $ controllers控制器数组
     * @param string $ plugin您正在制作控制器的插件的名称
     * @param string $ prefix您正在使控制器前缀的名称
     * @param mixed      $controllers
     * @param null|mixed $plugin
     * @param mixed      $prefix
     * @return数组
     */
    public function getControllersNames($controllers, $plugin = null, $prefix = 'Api') {
        $pluginPath = 'App';
        // pr($controllers);exit();
        // look at each controller
        $controllersNames = array();
        foreach ($controllers as $controller) {
            $tmp = explode('/', $controller);
            $controllerName = str_replace('Controller.php', '', array_pop($tmp));
            // Always skip the App controller
            if ($controllerName === 'App' || $controllerName === 'Error') {
                continue;
            }
            // Skip anything that is not a concrete controller
            $namespace = $this->_getNamespace($controller, $pluginPath, $prefix);
            if (!(new \ReflectionClass($namespace))->isInstantiable()) {
                continue;
            }
            $controllersNames[] = $controllerName;
        }

        return $controllersNames;
    }

    /**
     * 获取控制器中的方法名。
     *
     * @param array $file 控制器文件
     * @return数组
     */
    public function getActionList($file) {
        $dir = new Folder(APP.'Controller/Api');
        $file = $file.'Controller.php';
        $file = new File($dir->pwd().DS.$file);

        $file_contents = $file->read();
        $file->close();
        $calss_pattern = '/class [a-zA-Z0-9]*Controller extends AppController/';
        preg_match($calss_pattern, $file_contents, $matches);
        $class_name_1 = str_replace('class', '', $matches[0]);
        $class_name = str_replace('Controller extends AppController', '', $class_name_1);

        //get action name
        $pattern = '/function [a-zA-Z0-9]*/';
        preg_match_all($pattern, $file_contents, $matches);

        //Now gather action details together
        $action_group = array();

        $inflect = new Inflector();
        $class_name_sing = $inflect->singularize($class_name);

        $_action = str_replace('function', '', $matches[0]);

        foreach ($_action as $key => $value) {
            if (trim($value) && trim($value) !== 'initialize') {
                $actions['title'][] = trim($value);
            }
        }

        // $action_group['name'] = $class_name;
        // $action_group['name_singular'] = $class_name_sing;
        // $action_group['actions'] = $action;

        // $actions[] = $action_group;

        return $actions;
    }

    public function returnData($data) {
        $this->set('data', $data);
        $this->set('_serialize', array('data'));
    }

    public function cRedis($key, $val = null) {
        if (($result = Cache::read($key, 'redis')) === false) {
            Cache::write($key, $val, 'redis');
            $result = Cache::read($key, 'redis');
        }

        return $result;
    }

    //获取分页数据
    public function getListByPage($query, $order, $current_page = 1, $not_page = false, $limit = 20) {
        $sql = $query;

        if ($order) {
            $sql .= ' order by '.$order;
        }

        //要返回的数组
        $results = array();

        if ($not_page) {
            $results['data'] = $this->connection->execute($sql)->fetchAll('assoc');

            return $results;
        }

        $count = $this->connection->execute($sql)->rowCount();

        // 获取总页数
        $page_count = ceil($count / $limit);

        // 验证当前请求页码是否大于总页数
        if ($current_page > $page_count) {
            return $results;
        }

        // Adding LIMIT Clause
        if ($limit) {
            $sql .= ' limit '.(($current_page - 1) * $limit).', '.$limit;
        }

        $data = $this->connection->execute($sql)->fetchAll('assoc');

        if ($data) {
            $results['success'] = true;
            $results['data'] = $data;
        }

        $has_next_page = false;
        if ($page_count - $current_page) {
            $has_next_page = true;
        }

        $has_prev_page = false;
        if ($current_page > 1) {
            $has_prev_page = true;
        }

        $results['pagination'] = array(
            'page_count' => $page_count,
            'current_page' => $current_page,
            'has_next_page' => $has_next_page,
            'has_prev_page' => $has_prev_page,
            'count' => $count,
        );

        return $results;
    }

    //获取主键ID
    public function getId($table_name, $field_name) {
        $results = $this->connection
                    ->newQuery()
                    ->select('table_name,field_name,nextid')
                    ->from('ids')
                    ->where(array('table_name' => $table_name, array('field_name' => $field_name)))
                    ->execute()
                    ->fetch('assoc');

        if ($results) {
            $data['nextid'] = $results['nextid'] + 1;
            $this->connection
                        ->update('ids', array('nextid' => $data['nextid']), array('table_name' => $table_name, 'field_name' => $field_name));
        } else {
            $data['nextid'] = 1;
            $data['table_name'] = $table_name;
            $data['field_name'] = $field_name;
            $results = $this->connection->insert('ids', $data);
        }

        return $data['nextid'];
    }

    //保存、修改数据
    public function save($table_name, $field_name, $data) {
        $id = isset($data[$field_name]) ? (int) ($data[$field_name]) : 0;
        if ($id) {
            unset($data['userid']);
            $results = $this->connection
                        ->update($table_name,
                            $data,
                            array($field_name => $id)
                        );

            if ($results) {
                return $id;
            }
        }
        $id = $this->getId($table_name, $field_name);

        $data[$field_name] = $id;

        // return $data;
        $results = $this->connection->insert($table_name, $data);
        if ($results) {
            // $this->setId($table_name, $field_name, $id);

            return $id;
        }
    }

    //返回所有数据
    public function getFetchAll($table_name, $where = array(), $field_name = '*') {
        $results = $this->connection
                    ->newQuery()
                    ->select($field_name)
                    ->from($table_name)
                    ->where($where)
                    ->execute()
                    ->fetchAll('assoc');

        return $results;
    }

    //返回分页数据
    public function getPage($table_name, $cofigs) {
        $default = array(
            'where' => array(),
            'field_name' => '*',
            'order' => array(),
            'limit' => 20,
            'page' => 1,
        );
        $params = array_merge($default, $cofigs);

        $count = $this->connection
                ->newQuery()
                ->select($params['field_name'])
                ->from($table_name)
                ->where($params['where'])
                ->execute()
                ->rowCount();

        // 获取总页数
        $page_count = ceil($count / $params['limit']);

        //要返回的数组
        $results = array();

        // 验证当前请求页码是否大于总页数
        if ($params['page'] > $page_count) {
            return $results;
        }
        exit;
        $results['data'] = $this->connection
                    ->newQuery()
                    ->select($params['field_name'])
                    ->from($table_name)
                    ->where($params['where'])
                    ->order($params['order'])
                    ->limit($params['limit'])
                    ->page($params['page'])
                    ->execute()
                    ->fetchAll('assoc');

        return $results;
    }

    //删除数据
    public function del($table_name, $field_name, $id) {
        return $this->connection->delete($table_name, array($field_name => $id));
    }
}
