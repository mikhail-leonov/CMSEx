<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(VIEW . 'abstract.view.php');


use PHPUnit\Framework\TestCase;

class AbstractViewTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractView', ['']);
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
