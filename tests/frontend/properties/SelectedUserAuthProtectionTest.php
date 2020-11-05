<?php

namespace luya\userauth\tests\frontend\properties;

use luya\cms\menu\Item;
use luya\testsuite\traits\CmsDatabaseTableTrait;
use luya\userauth\frontend\properties\SelectedUserAuthProtection;
use luya\userauth\tests\UserAuthTestCase;

class SelectedUserAuthProtectionTest extends UserAuthTestCase
{
    use CmsDatabaseTableTrait;

    public function testUserInList()
    {
        $prop = new SelectedUserAuthProtection();
        $prop->value = '[]';
        $this->assertFalse($prop->userInList(1));

        $prop->value = '[{"value":1}]';
        $this->assertTrue($prop->userInList(1));
    }

    public function testIsActive()
    {
        $prop = new SelectedUserAuthProtection();

        $this->assertFalse($prop->isActive());
    }

    public function testMenuItem()
    {
        $item = new Item(['itemArray' => [
            'id' => 1,
            'nav_id' => 1,
        ]]);

        $this->createCmsNavFixture([
            1 => [
                'id' => 1,
            ]
        ]);

        $this->createCmsPropertyFixture();
        $this->assertFalse(SelectedUserAuthProtection::isHidden($item));
        $this->assertTrue(SelectedUserAuthProtection::isVisible($item));
    }
}