<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'api.model.php');


use PHPUnit\Framework\TestCase;

class APIModelTest extends TestCase
{
    public function testInstance()
    {
	$obj = new ApiModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ApiModel::class, $obj);
    }

    public function testselect_tag()
    {
	$obj = new ApiModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ApiModel::class, $obj);
    }

    public function testunselect_tag()
    {
	$obj = new ApiModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ApiModel::class, $obj);
    }

    public function testadd_tag()
    {
	$obj = new ApiModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ApiModel::class, $obj);
    }

    public function testdel_tag()
    {
	$obj = new ApiModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ApiModel::class, $obj);
    }

    public function testnew_tag()
    {
	$obj = new ApiModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ApiModel::class, $obj);
    }


}
