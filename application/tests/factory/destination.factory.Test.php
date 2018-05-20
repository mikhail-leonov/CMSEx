<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(FACTORY . 'destination.factory.php');


use PHPUnit\Framework\TestCase;

class DestinationFactoryTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $destination = DestinationFactory::build("sql");
        $this->assertNotEmpty($destination);
        $this->assertInstanceOf(SqlDestination::class, $destination);

        $obj = new DestinationFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DestinationFactory::class, $obj);
    
        $decorator = $obj->build("sql");
        $this->assertNotEmpty($destination);
        $this->assertInstanceOf(SqlDestination::class, $destination);
    }
    
    /**
      * @expectedException DestinationNotFoundException
      */
    public function testException()
    {
        $obj = new DestinationFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DestinationFactory::class, $obj);

        $Destination = $obj->build("api2");
    }
    public function testExceptionMessage()
    {
        $obj = new DestinationFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DestinationFactory::class, $obj);

        $this->expectExceptionMessage('Destination [SomethingDestination] is not found in file: D:\xampp\htdocs\recipe\application\import\destination.something.class.php.');

        $destination = $obj->build("something");
    }
}


