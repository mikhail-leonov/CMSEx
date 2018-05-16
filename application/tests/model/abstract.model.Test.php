<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'abstract.model.php');


use PHPUnit\Framework\TestCase;

class AbstractModelTest extends TestCase
{
    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractModel');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
