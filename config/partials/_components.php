<?php
/**
 * Date: 04.10.2017
 * Time: 11:07
 */

return [
    'errorHandler' => ['errorAction' => 'site/error'],
    'view' => 'sn\utilities\components\View',
    'keyStorage' => ['class' => 'sn\keystorage\components\KeyStorage'],
    'assetManager' => require(__DIR__ . '/_asset-manager.php'),
    'authManager' => require(__DIR__ . '/_auth-manager.php'),
    'urlManager' => require(__DIR__ . '/_url-manager.php'),
    'formatter' => require(__DIR__ . '/_formatter.php'),
    'response' => require(__DIR__ . '/_response.php'),
    'request' => require(__DIR__ . '/_request.php'),
    'cache' => require(__DIR__ . '/_cache.php'),
    'session' => require(__DIR__ . '/_session.php'),
    'user' => require(__DIR__ . '/_user.php'),
    'mailer' => require(__DIR__ . '/_mailer.php'),
    'log' => require(__DIR__ . '/_log.php'),
    'db' => require(__DIR__ . '/_db.php'),
];
