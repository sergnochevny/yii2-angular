<?php

//return [
//    'class' => 'yii\db\Connection',
//    'dsn' => 'mysql:host=127.0.0.1;dbname=restaurantxchange',
//    'username' => 'restaura',
//    'password' => 'TI-{$=(Xi[5=',
//    'charset' => 'utf8',
//];
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=sff_db;dbname=sff',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',
    'enableSchemaCache' => true,
    'schemaCacheDuration' => 3600,
    'schemaCache' => 'cache'
];
