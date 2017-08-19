<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Controller;

class TestController extends AppController {
    public function index() {
        $config = array(
          'method' => 'User.login',
          'params' => array(
            'user' => 'admin',
            'password' => 'admin',
            // 'userData' => true,
          ),
        );

        $res = api($config);
        pr($res);
        exit();
    }

    public function logout() {
        $config = array(
          'method' => 'User.logout',
          'params' => array(
            'user' => 'admin',
            'password' => 'admin',
            // 'userData' => true,
          ),
        );

        $res = api($config);
        pr($res);
        exit();
    }
}
