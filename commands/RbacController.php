<?php

namespace app\commands;

use sn\auth\traits\RbacInitTrait;
use app\rbac\rules\OwnerRule;
use yii\console\Controller;

/**
 * Class RbacController
 * @package console\controllers
 */
class RbacController extends Controller
{

    use RbacInitTrait;


    protected $permissions = [
        ['name' => 'auth.user.index', 'description' => 'auth.user.index'],
        ['name' => 'auth.user.create', 'description' => 'auth.user.create'],
        ['name' => 'auth.user.update', 'description' => 'auth.user.update'],
        ['name' => 'auth.user.delete', 'description' => 'auth.user.delete'],
        ['name' => 'auth.user.view', 'description' => 'auth.user.view'],

        ['name' => 'auth.auth.login', 'description' => 'Authentication login'],
        ['name' => 'auth.auth.logout', 'description' => 'Authentication logout'],
        ['name' => 'auth.auth.sign-up', 'description' => 'Authentication sign-up'],
        ['name' => 'auth.auth.confirm-sign-up', 'description' => 'Authentication confirm-sign-up'],
        ['name' => 'auth.auth.password-restore', 'description' => 'Authentication Password Restore'],
        ['name' => 'auth.auth.password-reset', 'description' => 'Authentication Password Reset'],
        ['name' => 'auth.profile.index', 'description' => 'Authentication Profiles list'],
        ['name' => 'auth.profile.view', 'description' => 'Authentication Profiles view'],
        ['name' => 'auth.profile.update', 'description' => 'Authentication Profiles update'],

        ['name' => 'site.index', 'description' => 'Site index view'],
        ['name' => 'site.settings', 'description' => 'Site Settings View'],
        ['name' => 'site.error', 'description' => 'Error page view'],
        ['name' => 'site.captcha', 'description' => 'Captcha generation'],

        ['name' => 'event.index', 'description' => 'Events list'],
        ['name' => 'event.view', 'description' => 'Event view'],
        ['name' => 'event.create', 'description' => 'Event add'],
        ['name' => 'event.update', 'description' => 'Event update'],
        ['name' => 'event.delete', 'description' => 'Event delete'],
        ['name' => 'event.count', 'description' => 'Events count'],

        ['name' => 'donate.get-key', 'description' => 'Donate get key'],
        ['name' => 'donate.charge', 'description' => 'Donate charge'],

        ['name' => 'debug', 'description' => 'Debug Module toolbar permissions'],
        ['name' => 'gii', 'description' => 'Gii Module Dev tools permissions'],

        [
            'name' => 'owner',
            'description' => 'Verify owner of events',
            'rule' => OwnerRule::class
        ],

    ];

    protected $roles = [
        ['name' => 'sadmin', 'description' => 'Super Admin Role'],
        ['name' => 'admin', 'description' => 'Admin Role'],
        ['name' => 'user', 'description' => 'User Role'],
        ['name' => 'all', 'description' => 'Guest Role. Don`t use it to assign to users.'],
    ];

    protected $dependencies = [
        'sadmin' => [
            'role' => ['admin'],
            'permission' => [
                'site.settings' => true,
            ]
        ],
        'admin' => [
            'role' => ['user'],
            'permission' => [
                'auth.profile.view' => true,
                'auth.user.index' => true,
                'auth.user.create' => true,
                'auth.user.update' => true,
                'auth.user.delete' => true,
                'auth.user.view' => true,

                'event.delete' => true,
            ]
        ],
        'user' => [
            'role' => ['all'],
            'permission' => [
                'auth.profile.update' => true,
                'auth.user.update' => true,
                'auth.user.view' => true,
                'auth.auth.logout' => true,

                'event.index' => true,
                'event.view' => true,
                'event.create' => true,
                'event.update' => true,
                'event.count' => true,

                'donate.get-key' => true,
                'donate.charge' => true,

                'owner' => true,
            ]
        ],
        'all' => [
            'permission' => [
                'auth.auth.login' => true,
                'auth.auth.sign-up' => true,
                'auth.auth.confirm-sign-up' => true,
                'auth.auth.password-restore' => true,
                'auth.auth.password-reset' => true,
                'site.index' => true,
                'site.error' => true,
                'site.captcha' => true,
                'debug' => true,
                'gii' => true
            ]
        ]
    ];


    /**
     * Initiate site. Creates roles all, user, admin and sadmin.
     * WARNING! If you already have db with roles, this will overwrite it.
     */
    public function actionInit()
    {
        $this->initRoles($this->roles);
        $this->initPermissions($this->permissions);
        $this->initDependencies($this->dependencies);
    }
}