<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(CONTROLLER . 'api.controller.php');

use PHPUnit\Framework\TestCase;

class ApiControllerTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testName()
    {
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'api');
        $this->assertNotEquals($obj->name, 'other');
    }

    public function testControllerName()
    {
        $obj = new ApiController();
        $obj->setControllerName();

        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'api');
        $this->assertNotEquals($obj->name, 'other');
    }

    public function testIndex()
    {
        $methodName = "index";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertEmpty($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertNotEmpty($response);
    }

    public function testSelectTag()
    {
        $methodName = "SelectTag";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertEmpty($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertNotEmpty($response);
    }

    public function testUnselectTag()
    {
        $methodName = "UnselectTag";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertEmpty($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertNotEmpty($response);
    }

    public function testAddTag()
    {
        $methodName = "AddTag";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertEmpty($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertNotEmpty($response);
    }

    public function testDelTag()
    {
        $methodName = "DelTag";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertEmpty($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertNotEmpty($response);
    }

    public function testNewTag()
    {
        $methodName = "NewTag";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertNegativeJsonresponse($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertEmpty($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=json");
        $this->assertNegativeJsonresponse($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=xml");
        $this->assertNegativeXmlresponse($response);
        
        $response = $this->callApiEndPoint('api/' . $methodName . "?format=array");
        $this->assertNotEmpty($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=null");
        $this->assertNotEmpty($response);
    }

    public function testSaveEntry()
    {
        $methodName = "SaveEntry";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertNegativeJsonresponse($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertEmpty($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=json");
        $this->assertNegativeJsonresponse($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=xml");
        $this->assertNegativeXmlresponse($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=array");
        $this->assertNotEmpty($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=null");
        $this->assertNotEmpty($response);
    }

    public function testSaveNewEntry()
    {
        $methodName = "SaveNewEntry";
        $obj = new ApiController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('ApiController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $this->callApiEndPoint('api/' . $methodName);
        $this->assertNegativeJsonresponse($response);
        
        $response = $this->callApiRedirect('api/' . $methodName);
        $this->assertEmpty($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=json");
        $this->assertNegativeJsonresponse($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=xml");
        $this->assertNegativeXmlresponse($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=array");
        $this->assertNotEmpty($response);

        $response = $this->callApiEndPoint('api/' . $methodName . "?format=null");
        $this->assertNotEmpty($response);
    }
}
