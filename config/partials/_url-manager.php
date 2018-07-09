<?php

use yii\web\UrlNormalizer;

return [
    'class' => 'yii\web\UrlManager',
    'enablePrettyUrl' => true,
    'showScriptName' => false,
    'normalizer' => [
        'class' => 'yii\web\UrlNormalizer',
        'action' => UrlNormalizer::ACTION_REDIRECT_PERMANENT,
    ],
    'rules' => [
        '/login' => '/auth/auth/login',
        '/logout' => '/auth/auth/logout',
        '/sign-up' => '/auth/auth/sign-up',
        '/confirm-sign-up' => '/auth/auth/confirm-sign-up',
        '/password-reset' => '/auth/auth/password-reset',
        '/password-restore' => '/auth/auth/password-restore',
        '<controller>' => '<controller>/index',
        '<controller>/<action>/<id:\d+>' => '<controller>/<action>',
        '<controller>/<action>' => '<controller>/<action>',
        '<module>/<controller>/<action>/<id:\d+>' => '<module>/<controller>/<action>',
        '<module>/<controller>/<action>' => '<module>/<controller>/<action>',
    ]
];