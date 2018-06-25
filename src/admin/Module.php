<?php

namespace luya\userauth\admin;

/**
 * Userauth Admin Module.
 *
 * File has been created with `module/create` command. 
 * 
 * @author
 * @since 1.0.0
 */
class Module extends \luya\admin\base\Module
{
    public $apis = [
        'api-userauth-user' => 'luya\userauth\admin\apis\UserController',
    ];
    
    public function getMenu()
    {
        return (new \luya\admin\components\AdminMenuBuilder($this))
            ->node('User', 'verified_user')
            ->group('Group')
            ->itemApi('User', 'userauthadmin/user/index', 'verified_user', 'api-userauth-user');
    }
}