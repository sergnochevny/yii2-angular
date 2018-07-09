<?php
/**
 * Copyright (c) 2017. sn
 */

use yii\helpers\Html;

/** @var $user sn\auth\models\User */
/** @var $password string */
?>
Dear <?= $user->username ?>,

Thank you for registering with "<?= Yii::$app->name; ?>"
Please save this email for feature references.
Your login: <?= $user->email ?>

Your password: <?= $password ?>

Click the link below to confirm your registration.
Link: <?= $confirmLink ?>
