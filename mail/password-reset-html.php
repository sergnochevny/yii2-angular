<?php
/**
 * Copyright (c) 2017. sn
 */

use yii\helpers\Html;

/** @var $this yii\web\View */
/** @var $user sn\auth\models\User */

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#ffffff">
  <tbody>
  <tr>
    <td style="padding: 30px 40px; line-height: 1.5;">
      Hello <?= Html::encode($user->username) ?>, <br/><br/>
      Please follow this link to reset your password:<br/>
        <?= Html::a(Html::encode($resetLink), $resetLink) ?> <br/><br/>
      If you need additional assistance, please contact us.
    </td>
  </tr>
  </tbody>
</table>

