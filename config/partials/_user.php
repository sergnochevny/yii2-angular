<?php
/**
 * Date: 04.10.2017
 * Time: 11:13
 */

use sn\auth\models\User;

return [
    'class' => 'sn\utilities\web\User',
    'identityClass' => User::class,
    'loginUrl' => ['auth/auth/login'],
    'enableAutoLogin' => false,
];