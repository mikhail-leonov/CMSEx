<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(FACTORY . 'source.factory.php');


use PHPUnit\Framework\TestCase;

class SourceFactoryTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $source = SourceFactory::build("sql");
        $this->assertNotEmpty($source);
        $this->assertInstanceOf(SqlSource::class, $source);

        $obj = new SourceFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SourceFactory::class, $obj);
    
        $decorator = $obj->build("sql");
        $this->assertNotEmpty($source);
        $this->assertInstanceOf(SqlSource::class, $source);
    }
    
    /**
      * @expectedException SourceNotFoundException
      */
    public function testException()
    {
        $obj = new SourceFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SourceFactory::class, $obj);

        $source = $obj->build("api2");
    }
    public function testExceptionMessage()
    {
        $obj = new SourceFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SourceFactory::class, $obj);

        $this->expectExceptionMessage('Source [SomethingSource] is not found in file: D:\xampp\htdocs\recipe\application\import\source.something.class.php.');

        $source = $obj->build("something");
    }
}


