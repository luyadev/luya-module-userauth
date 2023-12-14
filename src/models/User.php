<?php

namespace luya\userauth\models;

use luya\admin\aws\ChangePasswordActiveWindow;
use luya\admin\aws\ChangePasswordInterface;
use luya\admin\ngrest\base\NgRestModel;
use luya\userauth\frontend\Module;
use Yii;
use yii\web\IdentityInterface;

/**
 * User.
 *
 * File has been created with `crud/create` command.
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $password_salt
 */
class User extends NgRestModel implements IdentityInterface, ChangePasswordInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userauth_user';
    }

    /**
     * @inheritdoc
     */
    public static function ngRestApiEndpoint()
    {
        return 'api-userauth-user';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_BEFORE_VALIDATE, function () {
            if ($this->isNewRecord) {
                $this->password_salt = Yii::$app->security->generateRandomString();
                $this->password = Yii::$app->security->generatePasswordHash($this->password . $this->password_salt);
            }
        });
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => Module::t('userauth.models.user.username'),
            'password' => Module::t('userauth.models.user.password'),
            'password_salt' => Module::t('userauth.models.user.password_salt'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'password_salt'], 'required'],
            [['username'], 'string', 'max' => 80],
            [['password'], 'string', 'length' => 60],
            [['password_salt'], 'string', 'length' => 32],
            [['username'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestAttributeTypes()
    {
        return [
            'username' => 'text',
            'password' => 'password',
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestScopes()
    {
        return [
            ['list', ['username']],
            [['create'], ['username', 'password']],
            [['update'], ['username']],
            ['delete', true],
        ];
    }

    /**
     * @inheritdoc
     */
    public function ngRestActiveWindows()
    {
        return [
            ['class' => ChangePasswordActiveWindow::class],
        ];
    }

    /**
     * Validate the input user password.
     *
     * @param string $password
     * @return boolean
     */
    public function validateInputPassword($password)
    {
        return Yii::$app->security->validatePassword($password . $this->password_salt, $this->password);
    }

    // ChangePasswordInterface

    /**
     * @inheritdoc
     */
    public function changePassword($newPassword)
    {
        $salt = Yii::$app->security->generateRandomString();
        $password = Yii::$app->security->generatePasswordHash($newPassword . $salt);

        $this->updateAttributes(['password_salt' => $salt, 'password' => $password]);

        return true;
    }

    // UserIdentity

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return false;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return null;
    }

    public function validateAuthKey($authKey)
    {
        return false;
    }
}
