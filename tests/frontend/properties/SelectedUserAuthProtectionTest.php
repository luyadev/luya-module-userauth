<?php

namespace luya\userauth\tests\frontend\properties;

use luya\userauth\frontend\properties\SelectedUserAuthProtection;
use luya\userauth\tests\UserAuthTestCase;

class SelectedUserAuthProtectionTest extends UserAuthTestCase
{
    public function testUserInList()
    {
        $prop = new SelectedUserAuthProtection();
        $prop->value = '[]';
        $this->assertFalse($prop->userInList(1));

        $prop->value = '[{"value":1}]';
        $this->assertTrue($prop->userInList(1));
    }
}