<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(EXCEPTION . 'abstract.exception.php');


use PHPUnit\Framework\TestCase;

class AbstractExceptionTest extends TestCase
{
    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractException');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
