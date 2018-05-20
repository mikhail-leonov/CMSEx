<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(MODEL . 'import.model.php');


use PHPUnit\Framework\TestCase;

class ImportModelTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new ImportModel();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ImportModel::class, $obj);
        
        $obj = ModelFactory::build("import");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testGetRules()
    {
        $methodName = "GetRules";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testSave()
    {
        $methodName = "save";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testLoad()
    {
        $methodName = "load";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testStart()
    {
        $methodName = "start";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testRun()
    {
        $methodName = "run";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testBuildEnv()
    {
        $methodName = "BuildEnv";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testProccess()
    {
        $methodName = "proccess";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testProccessItem()
    {
        $methodName = "proccessItem";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testTest()
    {
        $methodName = "test";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testTable()
    {
        $methodName = "table";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testTableList()
    {
        $methodName = "tablelist";
        $obj = new ImportModel();
        $this->assertClassMethodExist('ImportModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
}
