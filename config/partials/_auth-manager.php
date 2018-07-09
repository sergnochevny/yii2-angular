<?php

$cache = require(__DIR__ . '/_cache.php');

return [
    'class' => 'sn\rbac\DbManager',
    'cache' => $cache,
    'defaultRoles' => ['all']
];