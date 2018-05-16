<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'entry.model.php');


use PHPUnit\Framework\TestCase;

class EntryModelTest extends TestCase
{
    public function testInstance()
    {
	$obj = new EntryModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(EntryModel::class, $obj);
    }

    public function testget_content()
    {
	$obj = new EntryModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(EntryModel::class, $obj);
    }

    public function testupdateEntry()
    {
	$obj = new EntryModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(EntryModel::class, $obj);
    }
}
