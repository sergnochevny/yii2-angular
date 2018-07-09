<?php
/**
 * Date: 04.10.2017
 * Time: 11:13
 */

return [
    'class' => 'yii\swiftmailer\Mailer',
    'useFileTransport' => YII_ENV_DEV ? true : false,
    'transport' => [
        'class' => 'Swift_SendmailTransport',
        'command' => '/usr/sbin/sendmail -bs',
    ]
];