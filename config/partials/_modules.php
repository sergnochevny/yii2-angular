<?php
/**
 * Date: 04.10.2017
 * Time: 11:07
 */

use app\models\forms\RegistrationForm;

return [
    'auth' => [
        'class' => 'sn\auth\Module',
        'viewPath' => '@app/views/auth',
        'signUpFormModel' => RegistrationForm::class
    ]
];
