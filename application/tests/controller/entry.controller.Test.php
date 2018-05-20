<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(CONTROLLER . 'entry.controller.php');


use PHPUnit\Framework\TestCase;

class EntryControllerTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

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
        $methodName = "index";
        $obj = new EntryController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('EntryController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
   }
    
    public function testView()
    {
        $methodName = "view";
        $obj = new EntryController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('EntryController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testPrint()
    {
        $methodName = "print";
        $obj = new EntryController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('EntryController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testEdit()
    {
        $methodName = "edit";
        $obj = new EntryController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('EntryController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testNew()
    {
        $methodName = "new";
        $obj = new EntryController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('EntryController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
}