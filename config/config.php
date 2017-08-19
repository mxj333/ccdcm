<?php
//ADDS CONFIGURE TO ALL VIEWS
class_alias('Cake\Core\Configure', 'Configure');
class_alias('Cake\Cache\Cache', 'Cache');
include 'functions.php';

$json_configs = Cache::read('Configs');

if (!file_exists(CACHE . '~config.php')) {
    foreach (json_decode($json_configs) as $key => $value) {
        $conf[$value->con_name] = $value->con_value;
    }

    saveCache('config', $conf);
}

$config = include CACHE . '~config.php';

foreach ($config as $key => $value) {
    Configure::write($key, $value);
}

include 'version.php';
