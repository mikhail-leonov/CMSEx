<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(CONTROLLER . 'entry.controller.php');


use PHPUnit\Framework\TestCase;

class EntryControllerTest extends TestCase
{
    public function testName()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'entry');
        $this->assertNotEquals($obj->name, 'other');
    }

    public function testControllerName()
    {
	$obj = new EntryController();
	$obj->setControllerName();

        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'entry');
        $this->assertNotEquals($obj->name, 'other');
    }
    
    public function testIndex()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);

    }
    
    public function testView()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);

    }
    
    public function testPrint()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);

    }
    
    public function testEdit()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);

    }
    
    public function testSave()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);

    }

    
    public function testEdittags()
    {
	$obj = new EntryController();
        $this->assertNotEmpty($obj);

    }

}