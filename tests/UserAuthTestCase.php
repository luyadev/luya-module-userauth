<?php

namespace luya\userauth\tests;

use luya\testsuite\cases\WebApplicationTestCase;

class UserAuthTestCase extends WebApplicationTestCase
{
    public function getConfigArray()
    {
        return [
            'id' => 'packagetest',
            'basePath' => __DIR__,
            'language' => 'en',
            'components' => [
                'db' => ['class' => 'yii\db\Connection', 'dsn' => 'sqlite::memory:']
            ],
            'modules' => [
                'admin' => [
                    'class' => 'luya\admin\Module',
                ],
                'userauthfrontend' => [
                    'class' => 'luya\userauth\frontend\Module',
                ],
                'userauthadmin' => 'luya\userauth\admin\Module',
            ]
        ];
    }
}
