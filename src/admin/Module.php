<?php

namespace luya\userauth\admin;

use luya\userauth\frontend\Module as FrontendModule;

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
            ->node(FrontendModule::t('userauth.admin.menu.node'), 'verified_user')
                ->group(FrontendModule::t('userauth.admin.menu.group'))
                    ->itemApi(FrontendModule::t('userauth.admin.menu.item.user'), 'userauthadmin/user/index', 'verified_user', 'api-userauth-user');
    }
}