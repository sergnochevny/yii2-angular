<?php
/**
 * Date: 26.10.2017
 * Time: 20:24
 */

namespace app\models\forms;

use sn\auth\models\forms\SignUpForm;
use sn\auth\models\User;
use sn\auth\models\Profile;
use Yii;

class RegistrationForm extends SignUpForm{

    /**
     * @var
     */

    public $first_name;
    public $last_name;
    public $username;
    public $email;
    public $password;


    public function rules()
    {
        return [
            [
                ['first_name', 'last_name', 'username', 'email', 'password'],
                'required',
                'message' => 'Field «{attribute}» cannot be empty'
            ],
            [['first_name', 'last_name', 'username'], 'filter', 'filter' => 'trim'],
            [
                'username',
                'unique',
                'targetClass' => User::class,
                'message' => 'Sorry, this username has already been taken.'
            ],
            [
                'username',
                'match',
                'pattern' => '/^.{2,31}$/',
                'message' => 'Only characters, numbers and underscores are allowed'
            ],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            [['first_name', 'last_name', 'username', 'email', 'password'], 'string', 'max' => 255],
            ['first_name', 'match', 'pattern' => '/^[A-Za-z0-9_\-\.]+$/iu', 'skipOnEmpty' => true],
            ['last_name', 'match', 'pattern' => '/^[A-Za-z0-9_\-\.]+?$/iu', 'skipOnEmpty' => true],
            [
                'email',
                'unique',
                'targetClass' => User::class,
                'message' => 'Sorry, this email address has already been taken.'
            ],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function signUp()
    {
        if ($this->validate()) {
            $transaction = Yii::$app->db->beginTransaction();
            $user = new User(['scenario' => User::SCENARIO_SIGN_UP]);
            $profile = new Profile();
            $user->load(['User' => ['username' => $this->username, 'email' => $this->email]]);
            $profile->load(['Profile' => ['first_name' => $this->first_name, 'last_name' => $this->last_name]]);

            $user->setPassword($this->password);
            $user->generateAuthKey();
            $user->setConfirmationToken();

            if ($user->save()) {
                $user->link('profile', $profile);
                $transaction->commit();
                $this->assignRole($user);
                $this->sendMails($user, $this->password);
            } else {
                $transaction->rollBack();
            }
            return $user;
        }

        return false;
    }

}