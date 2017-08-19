<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use Cake\Core\Plugin;
use Cake\Routing\Route\DashedRoute;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;

/*
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

//API路由前缀设置
Router::prefix('api', function ($routes) {
    $routes->extensions(array('json'));

    //API默认首页
    $routes->connect('/', array('controller' => 'Index', 'action' => 'index'));

    $routes->fallbacks('InflectedRoute');
});

//后台路由前缀设置
Router::prefix('zen', function ($routes) {
    $routes->extensions(array('json', 'xml', 'html', 'ajax'));

    //登录页面
    $routes->connect('/login/*', array('controller' => 'Users', 'action' => 'login'));

    //默认首页
    $routes->connect('/', array('controller' => 'Index', 'action' => 'index'));

    $routes->fallbacks('InflectedRoute');
});

Router::scope('/', function (RouteBuilder $routes) {
    /*
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', array('controller' => 'Index', 'action' => 'index'));

    /*
     * ...and connect the rest of 'Pages' controller's URLs.
     */
    $routes->connect('/pages/*', array('controller' => 'Pages', 'action' => 'display'));

    /*
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/*
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
