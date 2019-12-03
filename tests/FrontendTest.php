<?php
namespace VENDOR\NAME\tests;

use luya\testsuite\cases\WebApplicationTestCase;
use luya\userauth\frontend\controllers\DefaultController;
use luya\userauth\frontend\controllers\LogoutController;

class FrontendTest extends WebApplicationTestCase
{
    public function getConfigArray()
    {
        return [
            'id' => 'packagetest',
            'basePath' => __DIR__,
            'language' => 'en',
        ];
    }

    public function testControllers()
    {
        $default = new DefaultController('default', $this->app);
        $logout = new LogoutController('logout', $this->app);

        $this->assertNotNull($default);
        $this->assertNotNull($logout);
    }
}
