<?php

use yii\helpers\FileHelper;
use yii\web\HtmlResponseFormatter;
use yii\web\JsonResponseFormatter;
use yii\web\Response;

return [
    'format' => Response::FORMAT_JSON,
    'formatters' => [
        'pdf' => [
            'class' => 'sn\pdf\PdfResponseFormatter',
            'fontDataPath' => function(){
                return FileHelper::normalizePath(Yii::getAlias('@app/runtime/'));
            },
            'tempPath' => function(){
                return FileHelper::normalizePath(Yii::getAlias('@app/runtime/'));
            },
        ],
        Response::FORMAT_HTML => ['class' => HtmlResponseFormatter::class],
        Response::FORMAT_JSON => ['class' => JsonResponseFormatter::class]
    ],
];
