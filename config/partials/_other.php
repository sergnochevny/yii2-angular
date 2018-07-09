<?php
/**
 * Date: 04.10.2017
 * Time: 11:20
 */

return [
    'as access' => [
        'class' => 'sn\auth\behaviors\AccessControl'
    ],
    'as beforeAction' => [
        'class' => 'sn\auth\behaviors\LastActionBehavior',
    ],
    'as beforeRequest' => [
        'class' => 'app\behaviors\GetApplication',
    ],
];