<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller\Api;

use Cake\Cache\Cache;
use Cake\Core\App;
use Cake\Filesystem\File;
use Cake\Filesystem\Folder;
use Cake\Utility\Hash;
use Cake\Utility\Inflector;

class TestController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadComponent('Common');
        // $this->loadComponent('Csrf');
    }

    /**
     * > 接口说明：测试接口
     * <code>
     * URL地址：/test/index
     * 提交方式：POST
     * </code>
     * -----------------------
     * <code>.
     *
     * @tetle 测试接口
     * @action /test/index
     *
     * @method get
     * </code>
     */
    public function index() {
        // $config = $this->Api->config();
        // pr($config);
        // $redis = Cache::redis('redis_test', 'test 888');

        $key = 'posts';
        $testRedis = $this->cRedis($key);
        pr($testRedis);
        // if (!$data = Cache::read($key)) {
        //     // Cache::set('duration', '600'); // キャッシュの時間調整
        //     // Cache::write($key, array('test' => 'hoge'));
        //     Cache::write($key, 'test 8888', 'redis');
        // }

        // if (($posts = Cache::read('posts', 'redis')) === false) {
        //     $posts = 'test 888sssdfasd 98998';
        //     Cache::write('posts', $posts, 'redis');
        // }
        // Cache::increment('posts', $offset = 1, 'redis');
        // Cache::write('posts', $posts, 'redis');
   //      $redis = new \Redis();
   //      $redis->connect('127.0.0.1', 6379);
   //      echo 'Connection to server sucessfully';
   //       //查看服务是否运行
   // echo 'Server is running: '.$redis->ping();
        Cache::clear(false);
        // pr($posts);
        exit;

        $controllers = $this->getControllerList();
        // pr($controllers);
        // foreach ($controllers as $key => $controller) {
        // $controllerName[] = $this->updateControllers(APP . 'Controller/Api' . DS . $controller);
        $controllerName = $this->getControllersNames($controllers);
        // // }
        // pr($res);

        // $actionList = $this->getActionList($res[2]);
        // pr($actionList);
        // exit();
        $this->set(compact('controllerName'));
        $this->set('_serialize', array('controllerName'));
    }

    public function getFunction() {
        $params = $this->request->data;

        $action = $this->getActionList($params['con']);
        echo json_encode($action);
        exit;
    }

    public function getParams() {
        $fooReflection = new \Nette\Reflection\ClassType('IndexController');
        $fooReflection->hasAnnotation('author'); // returns TRUE
        $fooReflection->hasAnnotation('copyright'); // returns FALSE
    }

    //接口测试工具展示逻辑
    public function apiTestAction() {
        // 准备测试工具的javascript 方法
        echo "<script type='text/javascript' src='/js/apiTest.js'></script>\n";
        echo "<script type='text/javascript'>\n";
        echo '$(document).ready(function(){';
        echo 'var header={};';
        echo "$('.doTest').click(function(){apiTest(header)});";
        echo "});\n";
        echo "</script>\n";

        //获取接口信息
        $serviceName = $this->param('serviceName');
        $actionName = $this->param('actionName');
        $configList = $this->serviceConfigList[$serviceName][$actionName];
        if (!$configList) {
            echo "Error : can not found '$serviceName::$actionName'.\n";
            exit;
        }

        // append sid
        $configList['action'] = $this->url->format($configList['action']);

        //测试工具界面展示
        $action = $configList['action'];
        $method = $configList['method'];
        $html = "<input type='hidden' id='action' value='{$action}'/>\n";
        $html .= "<input type='hidden' id='method' value='{$method}'/>\n";
        $html .= "<table class='tbcom' cellpadding=1 cellspacing=1>\n";
        $html .= "<tr><td class='title' colspan=2>{$serviceName} > {$actionName}</td></tr>\n";
        foreach ((array) $configList as $configKey => $configVal) {
            // 接口参数信息 action params
            if (is_array($configVal)) {
                $html .= "<tr><td>Test Data</td><td><table>\n";
                foreach ((array) $configVal as $paramName => $paramData) {
                    $paramDval = $paramData['dval']; // default value
                    $paramDesc = $paramData['desc']; // description
                    $html .= "  <tr><td>KEY : <input type='text' name='paramKey' value='{$paramName}'/> VALUE : <input type='text' name='paramVal' style='width:300px' value='$paramDval'/> ({$paramDesc}) </td></tr>\n";
                }
                $html .= "</table></td></tr>\n";
            // action attr
            } else {
                $html .= "<tr><td class='left'>{$configKey}</td><td>{$configVal}</td></tr>\n";
            }
        }
        $html .= "<tr><td class='left'>Test Submit</td><td><input type='button' class='doTest' value='提交测试'/></td></tr>\n";
        $html .= "<tr><td class='left'>Test Result</td><td><textarea id='result'></textarea></td></tr>\n";
        $html .= "</table>\n";
        echo $html;
    }

    //获取API 接口信息列表
    public function _getServiceConfigList() {
        $dir = new Folder(APP.'/Controller/Api');

        $files = $dir->find('.*\.php');
        pr($files);
        foreach ($files as $file) {
            echo $file;
            $file = new File($dir->pwd().DS.$file);

            // echo $file . "<br>";
            $contents = $file->read();
            pr($contents);
            // $file->write('I am overwriting the contents of this file');
            // $file->append('I am adding to the bottom of this file.');
            // $file->delete(); // I am deleting this file
            $file->close(); // Be sure to close the file when you're done
        }
    }

    public function graphGet() {
        // get all graphs
        $params = $this->request->data;
        $data = $this->api->graphGet($params);
        // $data = $this->request->data;

        $this->set(compact('data'));
        $this->set('_serialize', array('data'));
    }

    protected function _printMenu() {
        echo "<a href='{$this->apiHome}'>Home</a>\n";
        echo "| <a href='{$this->apiList}'>Api Test</a>\n";
        echo "| <a href='{$this->apiStat}'>Api Stat</a>\n";
        echo "| <a href='{$this->apiQuit}'>Logout</a>\n";
        echo "<hr/>\n";
    }

    /**
     * Get the namespace for a given class.
     *
     * @param string $className  the class you want a namespace for
     * @param string $pluginPath the plugin path
     * @param string $prefixPath the prefix path
     *
     * @return string
     */
    protected function _getNamespace($className, $pluginPath = null, $prefixPath = null) {
        $namespace = preg_replace('/(.*)Controller\//', '', $className);
        $namespace = preg_replace('/\//', '\\', $namespace);
        $namespace = preg_replace('/\.php/', '', $namespace);
        $prefixPath = Inflector::camelize($prefixPath);
        if (!$pluginPath) {
            $rootNamespace = Configure::read('App.namespace');
        } else {
            $rootNamespace = preg_replace('/\//', '\\', $pluginPath);
        }
        $namespace = array(
            $rootNamespace,
            'Controller',
            $prefixPath,
            $namespace,
        );

        return implode('\\', Hash::filter($namespace));
    }

    /**
     * Check a node for existance, create it if it doesn't exist.
     *
     * @param string $path     The path to check
     * @param string $alias    The alias to create
     * @param int    $parentId the parent id to use when creating
     *
     * @return array Aco Node array
     */
    protected function _checkNode($path, $alias, $parentId = null) {
        $node = $this->Aco->node($path);
        if (!$node) {
            $aliases = explode('/', $alias);
            foreach ($aliases as $newAlias) {
                $parentId = !empty($node) ? $node->id : $parentId;
                $data = array(
                    'parent_id' => $parentId,
                    'model' => null,
                    'alias' => $newAlias,
                );
                $entity = $this->Aco->newEntity($data);
                $node = $this->Aco->save($entity);
            }
            $this->out(__d('cake_acl', 'Created Aco node: <success>{0}</success>', $path));
        } else {
            $node = $node->first();
        }

        return $node;
    }
}
