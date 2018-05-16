<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'destination.abstract.class.php');


use PHPUnit\Framework\TestCase;

class AbstractDestinationTest extends TestCase
{
    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractDestination');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
