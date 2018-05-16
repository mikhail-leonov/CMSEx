<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(CONTROLLER . 'abstract.controller.php');


use PHPUnit\Framework\TestCase;

class AbstractControllerTest extends TestCase
{
    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractController');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
