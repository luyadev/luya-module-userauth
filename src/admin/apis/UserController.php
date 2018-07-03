<?php

namespace luya\userauth\admin\apis;

/**
 * User Controller.
 *
 * File has been created with `crud/create` command.
 */
class UserController extends \luya\admin\ngrest\base\Api
{
    /**
     * @var string The path to the model which is the provider for the rules and fields.
     */
    public $modelClass = 'luya\userauth\models\User';
}
