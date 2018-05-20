<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(FACTORY . 'decorator.factory.php');


use PHPUnit\Framework\TestCase;

class DecoratorFactoryTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $decorator = DecoratorFactory::build("json");
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(JsonDecorator::class, $decorator);

        $obj = new DecoratorFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DecoratorFactory::class, $obj);
    
        $decorator = $obj->build("json");
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(JsonDecorator::class, $decorator);
    }
    
    /**
      * @expectedException DecoratorNotFoundException
      */
    public function testException()
    {
        $obj = new DecoratorFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DecoratorFactory::class, $obj);

        $Decorator = $obj->build("api2");
    }
    public function testExceptionMessage()
    {
        $obj = new DecoratorFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DecoratorFactory::class, $obj);

        $this->expectExceptionMessage('Decorator [somethingDecorator] is not found in file: D:\xampp\htdocs\recipe\application\decorator\something.decorator.php.');

        $decorator = $obj->build("something");
    }
}

