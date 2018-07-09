<?php

$params = require(__DIR__ . '/partials/_params.php');
$modules = require(__DIR__ . '/partials/_modules.php');
$components = require(__DIR__ . '/partials/_components.php');
$other = require(__DIR__ . '/partials/_other.php');

$config = [
    'id' => 'sff',
    'name' => 'Stupid FUN FundRaiser',

    'defaultRoute' => 'site/index',

    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'en',
    'timeZone' => 'UTC',
    'modules' => $modules,
    'components' => $components,
    'params' => $params,
];

if (is_array($other)){
    $config = array_merge($config, $other);
}

if(YII_ENV_DEV) {
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
