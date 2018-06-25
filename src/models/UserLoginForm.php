<?php

namespace luya\userauth\models;

use yii\base\Model;
use luya\userauth\frontend\Module;

/**
 * User Login Form.
 * 
 * @property \luya\userauth\models\User $user
 * 
 * @author Basil Suter <basil@nadar.io>
 * @since 1.0.0
 */
class UserLoginForm extends Model
{
    /**
     * @var string The username
     */
    public $username;
    
    /**
     * @var string The password for a given username.
     */
    public $password;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->on(self::EVENT_AFTER_VALIDATE, [$this, 'validateUser']);
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
        ];
    }

    /**
     * Validate the current input data against an user.
     * 
     * @return boolean
     */
    public function validateUser()
    {
        if (!$this->user) {
            return $this->addError('username', Module::t('userauth.models.userloginform.error.username'));
        }
        
        if (!$this->user->validateInputPassword($this->password)) {
            return $this->addError('password', Module::t('userauth.models.userloginform.error.password'));
        }
    }
    
    private $_user;
    
    /**
     * Get user object, contains false if not found.
     * 
     * @return \luya\userauth\models\User|boolean
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findOne(['username' => $this->username]);
        }
        
        return $this->_user;
    }
}