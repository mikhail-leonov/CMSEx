<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'import.model.php');


use PHPUnit\Framework\TestCase;

class ImportModelTest extends TestCase
{
    public function testInstance()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testgetRules()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testsave()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testload()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function teststart()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testrun()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testbuildEnv()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testproccess()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testproccessItem()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testtest()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testtable()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testtablelist()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

    public function testgetCFG()
    {
	$obj = new ImportModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(ImportModel::class, $obj);
    }

}
