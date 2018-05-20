<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(VIEW . 'page.view.php');
require_once(FACTORY . 'view.factory.php');


use PHPUnit\Framework\TestCase;

class PageViewTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new PageView("page.page");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(PageView::class, $obj);

        $obj = ViewFactory::build("page.page");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(PageView::class, $obj);
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException()
    {
        $obj = new PageView("");
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException1()
    {
        $obj = new PageView("wrong.page");
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException2()
    {
        $obj = new PageView("wrong.something");
    }

}
