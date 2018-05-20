<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(DECORATOR . 'abstract.decorator.php');


use PHPUnit\Framework\TestCase;

class AbstractDecoratorTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractDecorator');
    }
    
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
