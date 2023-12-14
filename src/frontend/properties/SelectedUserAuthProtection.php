<?php

namespace luya\userauth\frontend\properties;

use luya\admin\base\CheckboxArrayProperty;
use luya\cms\menu\Item;
use luya\helpers\ArrayHelper;
use luya\userauth\frontend\Module;
use luya\userauth\models\User;
use Yii;
use yii\web\ForbiddenHttpException;

class SelectedUserAuthProtection extends CheckboxArrayProperty
{
    /**
     * {@inheritDoc}
     */
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_BEFORE_RENDER, [$this, 'ensureUserSelection']);
    }

    /**
     * Check whether the current page requires protection and user is logged in.
     *
     * The protection check for the given users does not have an effect if:
     *
     * + Any user is logged (this means the permission check is not directly done by this property and must be done by {{UserAuthProtection}} class)
     * + Any user from the list has been selected
     */
    public function ensureUserSelection()
    {
        // when users are selected and the user is logged in, check for whether the user id is in the array or not.
        if ($this->isActive() && !$this->userInList(Yii::$app->user->id)) {
            throw new ForbiddenHttpException("Not permitted to view this page.");
        }
    }

    /**
     * Check if the given user is in the selected users list
     *
     * @param integer $userId
     * @return boolean
     */
    public function userInList($userId)
    {
        return in_array($userId, ArrayHelper::getColumn($this->getValue(), 'value'));
    }

    /**
     * Property activated status
     *
     * @return boolean Returns true if the property is active, which means there are values and a user is logged in.
     */
    public function isActive()
    {
        return !empty($this->getValue()) && !Yii::$app->user->isGuest;
    }

    /**
     * {@inheritDoc}
     */
    public function items()
    {
        return User::find()->select(['username', 'id'])->indexBy('id')->orderBy(['username' => SORT_ASC])->column();
    }

    /**
     * {@inheritDoc}
     */
    public function varName()
    {
        return 'selectedUserAuthProtection';
    }

    /**
     * {@inheritDoc}
     */
    public function label()
    {
        return Module::t('userauth.propertie.selecteduserauthprotection.label');
    }

    /**
     * {@inheritDoc}
     */
    public function help()
    {
        return Module::t('userauth.propertie.selecteduserauthprotection.hint');
    }

    /**
     * Check if a given item is visible for the current user or not.
     *
     * @param Item $item
     * @return boolean Whether the item is visible or not.
     */
    public static function isVisible(Item $item)
    {
        /** @var SelectedUserAuthProtection $prop */
        if ($prop = $item->getProperty(self::identifier())) {
            if ($prop->isActive()) {
                return $prop->userInList(Yii::$app->user->id);
            }
        }

        return true;
    }

    /**
     * Whether the given should be hidden or not.
     *
     * @param Item $item
     * @return boolean Returns true if hidden
     * @see {{SelectedUserAuthProtection::isVisible()}}
     */
    public static function isHidden(Item $item)
    {
        return !self::isVisible($item);
    }
}
