<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(CONTROLLER . 'api.controller.php');


use PHPUnit\Framework\TestCase;

class ApiControllerTest extends TestCase
{
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
	$obj = new ApiController();
        $this->assertNotEmpty($obj);

    }

    public function testselect_tag()
    {
	$obj = new ApiController();
        $this->assertNotEmpty($obj);

    }

    public function testunselect_tag()
    {
	$obj = new ApiController();
        $this->assertNotEmpty($obj);

    }

    public function testadd_tag()
    {
	$obj = new ApiController();
        $this->assertNotEmpty($obj);

    }

    public function testdel_tag()
    {
	$obj = new ApiController();
        $this->assertNotEmpty($obj);

    }

    public function testnew_tag()
    {
	$obj = new ApiController();
        $this->assertNotEmpty($obj);

    }
}
