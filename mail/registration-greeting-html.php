<?php

/** @var $user sn\auth\models\User */

/** @var $password string */

use yii\helpers\Html;

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
  <tbody>
  <tr>
    <td style="padding: 30px 40px; line-height: 1.5;">
      Dear <b><?= $user->username ?></b>,<br/>
      Thank you for registering with "<b><?= Yii::$app->name; ?></b>"<br/>
      Please save this email for feature references.<br/><br/>
      Your login:<br/>
      <a href="mailto:<?= Html::encode($user->email) ?>" target="_blank"
         style=""><?= Html::encode($user->email) ?>
      </a>
      <br/>
      Your password: <?= $password ?><br/><br/>
      Click the link below to confirm your registration.<br/>
      <?= Html::a(Html::encode($confirmLink), $confirmLink) ?>
    </td>
  </tr>
  </tbody>
</table>