<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(CONTROLLER . 'import.controller.php');


use PHPUnit\Framework\TestCase;

class ImportControllerTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testName()
    {
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'import');
        $this->assertNotEquals($obj->name, 'other');
    }

    public function testControllerName()
    {
        $obj = new ImportController();
        $obj->setControllerName();
    
        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'import');
        $this->assertNotEquals($obj->name, 'other');
    }
    
    public function testIndex()
    {
        $methodName = "index";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testLoad()
    {
        $methodName = "load";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testSave()
    {
        $methodName = "save";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testStart()
    {
        $methodName = "start";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    public function testTest()
    {
        $methodName = "test";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    public function testTable()
    {
        $methodName = "table";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    public function testTablelist()
    {
        $methodName = "tablelist";
        $obj = new ImportController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ImportController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
}
