<?php

namespace app\commands;

use sn\auth\models\User;
use yii\console\Controller;
use yii\helpers\Console;

/**
 * Class ProtusController
 * @package console\controllers
 */
class SffController extends Controller{

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return bool|int
     */
    private function createSuperAdminAccount($username, $email, $password){
        return $this->actionCreateUser("$username:$email:$password:sadmin");
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return bool|int
     */
    private function createAdminAccount($username, $email, $password){
        return $this->actionCreateUser("$username:$email:$password:admin");
    }

    /**
     * @param $username
     * @param $email
     * @param $password
     * @return bool|int
     */
    private function createUserAccount($username, $email, $password){
        return $this->actionCreateUser("$username:$email:$password:user");
    }

    /**
     * Initiate site. Creates accounts user, admin and sadmin.
     * WARNING! If you already have db with roles, this will overwrite it.
     * To add role or user see create-user respectively.
     */
    public function actionInit(){
        $sadminData = 'sadmin:sadmin@boxoffice.net:sadmin';
        list($username, $email, $password) = explode(":", $sadminData);
        $this->createSuperAdminAccount($username, $email, $password);

        $adminData = 'admin:admin@boxoffice.net:admin';
        list($username, $email, $password) = explode(":", $adminData);
        $this->createAdminAccount($username, $email, $password);

        $userData = 'user:user@boxoffice.net:user';
        list($username, $email, $password) = explode(":", $userData);
        $this->createUserAccount($username, $email, $password);
    }

    /**
     * Creates user and assigns a role. Usage: box-office/create-user username:email:password:role
     *
     * @param $userData
     */
    public function actionCreateUser($userData){
        list($username, $email, $password, $roleName) = explode(":", $userData);
        $manager = \Yii::$app->getAuthManager();
        $role = $manager->getRole($roleName);
        if(!empty($role)) {
            $user = !empty(User::findByUsername($username)) ? User::findByUsername($username) : User::findByEmail($username);
            if(empty($user)) {
                $user = new User();
                $user->username = $username;
            } else {
                $update = true;
            }
            $user->email = $email;
            $user->setPassword($password);
            $user->generateAuthKey();
            if(!$user->save()) {
                $this->stdout('User ' . $user->username . ' was not created' . PHP_EOL, Console::FG_RED);
            } else {
                $user->setConfirmationToken();
                $user->confirmAccount();
                if(empty($manager->getAssignment($roleName, $user->id))) {
                    $manager->assign($role, $user->id);
                }
                if(empty($update)) {
                    $msg = 'User ' . $user->username . ' was successfully created with role ' . $role->name . PHP_EOL;
                } else {
                    $msg = 'User ' . $user->username . ' was successfully updated with role ' . $role->name . PHP_EOL;
                }
            }
            $this->stdout($msg, Console::FG_GREEN);
        } else {
            $this->stderr('This role does not exists' . PHP_EOL, Console::FG_RED);
        }
    }

    /**
     * Remove user from db. Warning! This is DELETE FROM query and not just change status to DELETE
     * @param string $username
     * @return string
     */
    public function actionRemoveUser($username){
        $user = !empty(User::findByUsername($username)) ? User::findByUsername($username) : User::findByEmail($username);
        if($user) {
            $manager = \Yii::$app->getAuthManager();
            $manager->revokeAll($user->id);
            $rows = $user->delete();
            if($rows > 0) {
                return $this->stdout('User was removed' . PHP_EOL, Console::FG_GREEN);
            } else {
                return $this->stdout('Nothing to remove' . PHP_EOL, Console::FG_GREEN);
            }
        }

        return $this->stdout('User not found' . PHP_EOL, Console::FG_RED);
    }
}