<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
include_once(dirname(dirname(dirname(__FILE__))) . '/config/config.php');
require_once(FACTORY . 'model.factory.php');


use PHPUnit\Framework\TestCase;

class ModelFactoryTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $model = ModelFactory::build("api");
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(ApiModel::class, $model);

        $obj = new ModelFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ModelFactory::class, $obj);
    
        $model = $obj->build("api");
        $this->assertNotEmpty($model);
        $this->assertInstanceOf(ApiModel::class, $model);
    }

    /**
      * @expectedException ModelNotFoundException
      */
    public function testException()
    {
        $obj = new ModelFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ModelFactory::class, $obj);

        $model = $obj->build("api2");
    }
    public function testExceptionMessage()
    {
        $obj = new ModelFactory();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ModelFactory::class, $obj);

        $this->expectExceptionMessage('Model [api2Model] is not found in file: D:\xampp\htdocs\recipe\application\model\api2.model.php.');

        $model = $obj->build("api2");
    }
}
