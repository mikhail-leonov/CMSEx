<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(CONTROLLER . 'home.controller.php');


use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testName()
    {
        $obj = new HomeController();
        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'home');
        $this->assertNotEquals($obj->name, 'other');
    }

    public function testControllerName()
    {
        $obj = new HomeController();
        $obj->setControllerName();
    
        $this->assertNotEmpty($obj);
        $this->assertNotEmpty($obj->name);
        $this->assertEquals($obj->name, 'home');
        $this->assertNotEquals($obj->name, 'other');
    }
    
    public function testIndex()
    {
        $methodName = "index";
        $obj = new HomeController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('HomeController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
    
    public function testSearch()
    {
        $methodName = "search";
        $obj = new HomeController();
        $this->assertNotEmpty($obj);
        $this->assertClassMethodExist('HomeController', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
    }
}
