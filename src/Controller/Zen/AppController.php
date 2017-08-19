<?php
namespace App\Controller\Zen;

use Cake\Cache\Cache;
// use Cake\Controller\Component\CookieComponent;
use Cake\Controller\Controller;
use Cake\Event\Event;

class AppController extends \Cake\Controller\Controller {
    use \Crud\Controller\ControllerTrait;

    public function initialize() {

        parent::initialize();

        // I18n::locale('zh_CN');
        $this->viewClass = 'CrudView\View\CrudView';

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Cookie');
        $this->loadComponent('Crud.Crud', [
            'actions' => [
                'Crud.Index',
                'Crud.View',
                'Crud.Add',
                'Crud.Edit',
                'Crud.Delete',
            ],
            'listeners' => [
                // New listeners that need to be added:
                'CrudView.View',
                'Crud.Redirect',
                'Crud.RelatedModels',
                'CrudView.Search',
                'Crud.ApiPagination',
            ],
        ]);

        $this->loadComponent(
            'Auth', [
                'authorize' => 'Controller',
                // 'authorize' => [
                //     'Acl.Actions' => ['actionPath' => 'controllers/'],
                // ],
                'loginAction' => [
                    'plugin' => false,
                    'controller' => 'Users',
                    'action' => 'login',
                    'prefix' => 'zen',
                ],
                'loginRedirect' => [
                    'plugin' => false,
                    'prefix' => 'zen',
                    'controller' => 'Index',
                    'action' => 'index',
                ],
                'logoutRedirect' => [
                    'plugin' => false,
                    'prefix' => 'zen',
                    'controller' => 'Users',
                    'action' => 'login',
                ],
                'unauthorizedRedirect' => [
                    'plugin' => false,
                    'prefix' => 'zen',
                    'controller' => 'Users',
                    'action' => 'login',
                ],
                // 'scope' => ['Users.group_id' => 1],
                'authError' => false,
                'flash' => [
                    'element' => 'error',
                ],
                'storage' => 'Session',
            ]);

        $this->user = $this->Auth->user();

        //初始化
        $this->cacheData();

        //后台一级菜单
        $this->structures = Cache::read('structures');

        //后台二级菜单
        $this->managements = Cache::read('managements');
        $user = $this->user;

        //如果为普通用户则不能登录
        if ($user && $user['group_id'] != 1) {
            $this->Cookie->delete('RememberMe');
            return $this->redirect($this->Auth->logout());
        }

		$this->viewBuilder()->setLayout('zen');
        $username = $user['surname'] ? $user['surname'] : $user['username'];
        $this->set('username', $username);
    }

    //在视图呈现之前,调用控制器操作逻辑。
    public function beforeRender(Event $event) {
        parent::beforeRender($event);

        //选中当前并赋值给视图
        $controllerName = ($this->request->params['controller']);
        $ZEN_MEUN = ZEN_MEUN($this->structures, $this->managements, $controllerName);
        $bannerActive = isset($ZEN_MEUN['bannerActive']) ? intval($ZEN_MEUN['bannerActive']) : 1;

        //面包宵
        $breadcrumb = breadcrumb($ZEN_MEUN, $bannerActive, $controllerName, 1);

        $this->set(compact('ZEN_MEUN', 'bannerActive', 'controllerName', 'breadcrumb'));
    }

    //简单的授权或您需要使用模型和组件的组合来做您的授权，是否允许用户访问请求的资源,
    public function isAuthorized($user = null) {

        //只有管理员可以访问管理功能
        if ($this->request->params['prefix'] === 'zen') {
            return (bool) (in_array($user['group_id'], [1, 3]));
        }

        //默认拒绝
        return false;
    }

    // 缓存数据
    public function cacheData() {
        $arr = array('Configs', 'Structures', 'Managements');
        foreach ($arr as $value) {
            $this->reCache($value);
        }
    }

    // 缓存数据
    public function reCache($name, $config = array()) {
        $_name = strtolower($name);
        if (($result = Cache::read("$_name")) === false) {
            $this->loadModel("$name");
            switch ($name) {
            case 'Structures':
                $config = ['order' => ['weight' => 'ASC']];
                break;
            case 'Managements':
                $config = ['order' => ['weight' => 'ASC']];
                break;
            case 'Navigations':
                $config = ['order' => ['position' => 'ASC']];
                break;
            default:
                # code...
                break;
            }

            $default = [
                'where' => ['status' => 1],
                'order' => ['id' => 'ASC'],
            ];
            $config = array_merge($default, $config);

            $json = $this->$name->find('all')
                ->where($config['where'])
                ->order($config['order'])
                ->toArray();
            $result = json_encode($json);

            $data = [];
            if ($name == 'Managements') {
                foreach ($json as $key => $value) {
                    $data[$value['structure_id']][] = $value;
                }
                $result = json_encode($data);
            }

            if ($name == 'Configs') {
                foreach ($json as $key => $value) {
                    $conf[$value->con_name] = $value->con_value;
                }
                $this->saveCache('config', $conf);
            }

            Cache::write('' . $_name, $result);
        }

    }

    // 保存缓存数据
    public function saveCache($name, $value) {
        return file_put_contents(CACHE . '~' . $name . '.php', "<?php return " . var_export($value, true) . ";?>");
    }
}