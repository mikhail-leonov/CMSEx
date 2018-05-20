<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(MODEL . 'api.model.php');
require_once(FACTORY . 'model.factory.php');


use PHPUnit\Framework\TestCase;

class APIModelTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new ApiModel();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ApiModel::class, $obj);

        $obj = ModelFactory::build("api");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(ApiModel::class, $obj);
    }

    public function testSelectTag()
    {
        $methodName = "SelectTag";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testUnselectTag()
    {
        $methodName = "UnselectTag";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testAddTag()
    {
        $methodName = "AddTag";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testDelTag()
    {
        $methodName = "DelTag";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testNewTag()
    {
        $methodName = "NewTag";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testFindTags()
    {
        $methodName = "FindTags";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testAssignTags()
    {
        $methodName = "AssignTags";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testSaveEntry()
    {
        $methodName = "SaveEntry";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

    public function testSaveNewEntry()
    {
        $methodName = "SaveNewEntry";
        $obj = new ApiModel();
        $this->assertClassMethodExist('ApiModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }

}
