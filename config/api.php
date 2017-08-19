<?php

/*
 * This file is part of PHP CS Fixer.
 * (c) Fabien Potencier <mxj>
 *     Dariusz Rumiński <dariusz.ruminski@gmail.com>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

// class_alias('Cake\Http\Client', 'Client');
class_alias('Cake\Http\ServerRequest', 'ServerRequest');
class_alias('GuzzleHttp\Client', 'Http');
class_alias('GuzzleHttp\Psr7\Request', 'Request');
class_alias('Cake\View\JsonView', 'JsonView');

function api($config, $scheme = 'http', $type = 'POST', $json = true) {
    $ServerRequest = new ServerRequest();
    $method = strtolower(strtr($config['method'], '.', '/')).'.json';
    $client = new Http(array('base_uri' => $scheme.'://'.$ServerRequest->env('HTTP_HOST').'/api/', 'timeout' => 2.0));
    $res = $client->request($type, $method, array(
      'form_params' => $config['params'],
    ));

    $result = array();
    if ($res->getStatusCode() === 200) {
        $result = json_decode($res->getBody(), true);
        if ($json) {
            $result = json_encode($result);
        }
    }

    return $result;
}
