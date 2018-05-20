<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(EXCEPTION . 'abstract.exception.php');


use PHPUnit\Framework\TestCase;

class AbstractExceptionTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractException');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
