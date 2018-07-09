<?php

use sn\utilities\components\AssetManager;

$bundles = require(__DIR__ . '/_asset-bundles.php');

return [
    'class' => 'sn\utilities\components\AssetManager',
    'linkAssets' => true,

    'injectionCssScheme' => AssetManager::SCHEME_INJECTION_STANDARD,
    'injectionJsScheme' => AssetManager::SCHEME_INJECTION_STANDARD,

//    'lazyPublish' => true,
//    'beforeCopy' => function($from, $to){
//        return !is_file($from) || !file_exists($to) || (filesize($from) !== filesize($to));
//    },
//    'excludeOptions' => ['only' => ['*.js', '*.css', '*.map', '*.png', '*.ttf', '*.woff', '*.jpg', '*.gif']],

    'bundles' => $bundles
];