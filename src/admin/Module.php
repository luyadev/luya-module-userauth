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
            ->node('userauthadmin.admin.menu.node', 'verified_user')
                ->group('userauthadmin.admin.menu.group')
                    ->itemApi('userauthadmin.admin.menu.item.user', 'userauthadmin/user/index', 'people', 'api-userauth-user');
    }

    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        self::registerTranslation('userauthadmin', static::staticBasePath() . '/messages', [
            'userauthadmin' => 'userauthadmin.php',
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('userauthadmin', $message, $params);
    }
}
