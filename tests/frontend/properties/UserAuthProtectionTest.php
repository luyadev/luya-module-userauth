<?php

namespace luya\userauth\tests\frontend\properties;

use luya\userauth\frontend\properties\UserAuthProtection;
use luya\userauth\tests\UserAuthTestCase;

class UserAuthProtectionTest extends UserAuthTestCase
{
    public function testMetaMethods()
    {
        $prop = new UserAuthProtection();
        $this->assertNotEmpty($prop->label());
        $this->assertNotEmpty($prop->help());
    }
}
