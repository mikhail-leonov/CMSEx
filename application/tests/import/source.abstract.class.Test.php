<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'source.abstract.class.php');


use PHPUnit\Framework\TestCase;

class AbstractSourceTest extends TestCase
{
    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractSource');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
