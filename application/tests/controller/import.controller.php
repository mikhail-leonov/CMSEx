<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(CONTROLLER . 'import.controller.php');


use PHPUnit\Framework\TestCase;

class ImportControllerTest extends TestCase
{
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
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
    
    public function testLoad()
    {
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
    
    public function testSave()
    {
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
    
    public function testStart()
    {
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
    public function testTest()
    {
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
    public function testTable()
    {
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
    public function testTablelist()
    {
	$obj = new ImportController();
        $this->assertNotEmpty($obj);

    }
}