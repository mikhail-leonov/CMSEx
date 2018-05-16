<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(FACTORY . 'abstract.factory.php');


use PHPUnit\Framework\TestCase;

class AbstractFactoryTest extends TestCase
{
    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractFactory');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
