<?php

$params = require(__DIR__ . '/partials/_params.php');
$db = require(__DIR__ . '/partials/_db.php');

$config = [
    'id' => 'box-office-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'components' => [
        'keyStorage' => [
            'class' => 'sn\keystorage\components\KeyStorage',
        ],
        'authManager' => require(__DIR__ . '/partials/_auth-manager.php'),
        'formatter' => require(__DIR__ . '/partials/_formatter.php'),
        'cache' => require(__DIR__ . '/partials/_cache.php'),
        'user' => require(__DIR__ . '/partials/_user.php'),
        'log' => require(__DIR__ . '/partials/_log.php'),
        'db' => require(__DIR__ . '/partials/_db.php'),
    ],
    'modules' => [
        'auth' => [
            'class' => 'sn\auth\Module',
            'viewPath' => '@app/views/auth'
        ],
    ],
    'params' => $params,
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
