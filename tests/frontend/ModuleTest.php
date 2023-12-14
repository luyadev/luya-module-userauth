<?php

namespace luya\userauth\tests\frontend;

use luya\userauth\frontend\controllers\DefaultController;
use luya\userauth\frontend\controllers\LogoutController;
use luya\userauth\tests\UserAuthTestCase;

class ModuleTest extends UserAuthTestCase
{
    public function testControllers()
    {
        $default = new DefaultController('default', $this->app);
        $logout = new LogoutController('logout', $this->app);

        $this->assertNotNull($default);
        $this->assertNotNull($logout);
    }
}
