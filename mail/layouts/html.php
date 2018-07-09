<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset="<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
  </head>
  <body style="margin:0;">
  <?php $this->beginBody() ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="0"
         style="font-family:Helvetica Neue, arial; font-size: 14px; line-height: 2em; color:#7E7E7E;">
    <tbody>
    <tr>
      <td align="center" valign="top" bgcolor="#ddd">
        <center style="max-width: 600px; width: 100%;">
          <table border="0" cellpadding="0" cellspacing="0" style="margin:0; padding:0" width="100%">
            <tbody>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f8f8f8"
                       style="padding: 0px 30px;">
                  <tbody>
                  <tr>
                    <td width="121" align="center" valign="middle" style="padding: 10px;"><a
                        href="<?= Url::to(['/'], true) ?>" target="_blank"><img width="141" height="72"
                                                                                style="border:0; margin:0; padding:0; display:block;"
                                                                                src="<?= Url::to(['/images/letter-logo.png'], true) ?>"
                                                                                title="Stupid Fun Fundraiser"
                                                                                alt="Stupid Fun Fundraiser"></a></td>
                    <td width="459" align="right" valign="middle"
                        style="font-family:Helvetica Neue, arial; font-size: 17px; line-height: 1.5em; color:#012353; padding: 10px;">
                      <b><span style="color:red">Stupid</span><span
                          style="color:rgba(0, 0, 0, 0.4);"> Fun</span>
                        <span>Fundraiser</span></b>
                    </td>
                  </tr>
                  </tbody>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#012353">
                  <tbody>
                  <tr>
                    <td></td>
                  </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td align="center" valign="middle">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tbody>
                  <tr>
                    <td><img style="border:0; margin:0; padding:0; display:block;"
                             src="<?= Url::to(['/images/letter.jpg'], true) ?>" width="600"
                             height="250" title="Stupid Fun Fundraiser" alt="Stupid Fun Fundraiser">
                    </td>
                  </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            <tr>
              <td align="left" valign="middle">
                  <?= $content ?>
              </td>
            </tr>
            <tr>
              <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="2" bgcolor="#012353">
                  <tbody>
                  <tr>
                    <td></td>
                  </tr>
                  </tbody>
                </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#f8f8f8">
                  <tbody>
                  <tr>
                    <td valign="middle" style="padding: 10px; text-align:center;"><a
                        href="tel:7706530958" target="_blank" style="color: #012353">770-653-0958</a>
                    </td>
                    <td valign="middle" style="padding: 10px; text-align:center;">
                      <a href="mailto:<?=\Yii::$app->keyStorage->get('system.sendto')?>" target="_blank"
                         style="color: #012353; display: block; line-height: 1.5;"><?=Html::encode(\Yii::$app->keyStorage->get('system.sendto'));?></a>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </td>
            </tr>
            </tbody>
          </table>
        </center>
      </td>
    </tr>
    </tbody>
  </table>
  <?php $this->endBody() ?>
  </body>
  </html>
<?php $this->endPage() ?>