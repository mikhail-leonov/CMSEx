<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
include_once(dirname(dirname(dirname(__FILE__))) . '/config/config.php');
require_once(FACTORY . 'view.factory.php');
require_once(VIEW . 'part.view.php');


use PHPUnit\Framework\TestCase;

class ViewFactoryTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $model = ViewFactory::build("entry_edit.part");
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(PartView::class, $model);

        $obj = new ViewFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ViewFactory::class, $obj);
    
        $model = $obj->build("entry_edit.part");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(PartView::class, $model);
    }

    /**
      * @expectedException ViewNotFoundException
      */
    public function testException()
    {
        $obj = new ViewFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ViewFactory::class, $obj);

        $model = $obj->build("other.part");
    }
    public function testExceptionMessage()
    {
        $obj = new ViewFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ViewFactory::class, $obj);

        $this->expectExceptionMessage('View [other2.part] is not found in file: D:\xampp\htdocs\recipe\application\view\parts\other2.part.view.html.');

        $model = $obj->build("other2.part");
    }
}
