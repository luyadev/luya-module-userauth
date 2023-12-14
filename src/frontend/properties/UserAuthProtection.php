<?php

namespace luya\userauth\frontend\properties;

use luya\admin\base\CheckboxProperty;
use luya\admin\models\Config;
use luya\cms\frontend\events\BeforeRenderEvent;
use luya\cms\menu\QueryOperatorFieldInterface;
use luya\userauth\frontend\Module;
use Yii;

/**
 * User Auth Protection property.
 *
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
class UserAuthProtection extends CheckboxProperty
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_BEFORE_RENDER, [$this, 'ensureUserAccess']);
    }

    /**
     * Check whether the current page requires protection and user is logged in.
     *
     * @param BeforeRenderEvent $event
     */
    public function ensureUserAccess(BeforeRenderEvent $event)
    {
        if ($this->getValue() == 1 && Yii::$app->user->isGuest) {
            // find the nav item to redirect from config
            $navItem = Yii::$app->menu->find()->where([QueryOperatorFieldInterface::FIELD_NAVID => Config::get(Module::USERAUTH_CONFIG_REDIRECT_NAV_ID)])->with(['hidden'])->one();

            // redirect to the given nav item
            return Yii::$app->response->redirect($navItem->absoluteLink . '?redir=' . urlencode($event->menu->absoluteLink));
        }
    }

    /**
     * @inheritdoc
     */
    public function varName()
    {
        return 'userAuthProtection';
    }

    /**
     * @inheritdoc
     */
    public function label()
    {
        return Module::t('userauth.propertie.userauthprotection.label');
    }

    /**
     * {@inheritDoc}
     */
    public function help()
    {
        return Module::t('userauth.propertie.userauthprotection.hint');
    }
}
