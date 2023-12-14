<?php

namespace luya\userauth\frontend;

/**
 * Userauth Admin Module.
 *
 * File has been created with `module/create` command.
 *
 * @author
 * @since 1.0.0
 */
class Module extends \luya\base\Module
{
    public const USERAUTH_CONFIG_REDIRECT_NAV_ID = 'userauth_redirect_nav_id';

    public const USERAUTH_CONFIG_AFTER_LOGIN_NAV_ID = 'userauth_afterlogin_nav_id';

    /**
     * @inheritdoc
     */
    public static function onLoad()
    {
        self::registerTranslation('userauth', static::staticBasePath() . '/messages', [
            'userauth' => 'userauth.php',
        ]);
    }

    /**
     * @inheritdoc
     */
    public static function t($message, array $params = [])
    {
        return parent::baseT('userauth', $message, $params);
    }
}
