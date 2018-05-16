<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(CONTROLLER . 'home.controller.php');


use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
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
	$obj = new HomeController();
        $this->assertNotEmpty($obj);

    }
    
    public function testSearch()
    {
	$obj = new HomeController();
        $this->assertNotEmpty($obj);

    }
}