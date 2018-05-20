<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(VIEW . 'part.view.php');
require_once(FACTORY . 'view.factory.php');


use PHPUnit\Framework\TestCase;

class PartViewTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new PartView("left_menu.part");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(PartView::class, $obj);

        $obj = ViewFactory::build("left_menu.part");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(PartView::class, $obj);
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException()
    {
        $obj = new PartView("");
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException1()
    {
        $obj = new PartView("wrong.part");
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException2()
    {
        $obj = new PartView("wrong.something");
    }
}
