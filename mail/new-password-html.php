<?php
/**
 * Copyright (c) 2017. sn
 */

use yii\helpers\Html;

/** @var $newPassword string */
/** @var $user sn\auth\models\User */

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
  <tbody>
  <tr>
    <td style="padding: 30px 40px; line-height: 1.5;">
      Hello <b><?= Html::encode($user->username) ?></b>, <br/><br/>
      There is your new password: <?= $newPassword ?> <br/><br/>
      Keep it in secure place.<br/>
      If you need additional assistance, please contact us.
    </td>
  </tr>
  </tbody>
</table>
