<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'source.abstract.class.php');


use PHPUnit\Framework\TestCase;

class AbstractSourceTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function setUp()
    {
        $this->object = $this->getMockForAbstractClass('AbstractSource');
    }

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
