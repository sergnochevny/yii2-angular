<?php

use yii\helpers\Html;

?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
  <tbody>
  <tr>
    <td style="padding: 30px 40px; line-height: 1.5;">
      Dear "<b><?= Yii::$app->name ?></b>" Admin,<br/>
      You have a new user registered on your website<br/>
      User email:<a href="mailto:<?= Html::encode($user->email) ?>" target="_blank"
                    style=""><?= Html::encode($user->email) ?></a>
    </td>
  </tr>
  </tbody>
</table>