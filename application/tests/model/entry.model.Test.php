<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(MODEL . 'entry.model.php');


use PHPUnit\Framework\TestCase;

class EntryModelTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new EntryModel();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(EntryModel::class, $obj);
        
        $obj = ModelFactory::build("entry");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(EntryModel::class, $obj);
    }

    public function testGetEntryData()
    {
        $methodName = "GetEntryData";
        $obj = new EntryModel();
        $this->assertClassMethodExist('EntryModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $response = $obj->GetEntryData('');
        $this->assertEmpty($response);
        $this->assertInternalType('array', $response);
        $this->assertEquals(0, count($response));

        $response = $obj->GetEntryData('0');
        $this->assertEmpty($response);
        $this->assertInternalType('array', $response);
        $this->assertEquals(0, count($response));

        $response = $obj->GetEntryData('1');
        $this->assertNotEmpty($response);
        $this->assertInternalType('array', $response);
        $this->assertGreaterThan(0, count($response));
    }

    public function testCreateEntry()
    {
        $methodName = "CreateEntry";
        $obj = new EntryModel();
        $this->assertClassMethodExist('EntryModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
        
        $response = $obj->CreateEntry('', '');
        $this->assertEquals(0, $response);

        $response = $obj->CreateEntry('', 'test');
        $this->assertEquals(0, $response);

        $response = $obj->CreateEntry('test', '');
        $this->assertEquals(0, $response);

    }

    public function testUpdateEntry()
    {
        $methodName = "UpdateEntry";
        $obj = new EntryModel();
        $this->assertClassMethodExist('EntryModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
        
        $response = $obj->UpdateEntry('', '', '');
        $this->assertEquals(0, $response);
        
        $response = $obj->UpdateEntry('', 'test', '');
        $this->assertEquals(0, $response);
        
        $response = $obj->UpdateEntry('', '', 'test');
        $this->assertEquals(0, $response);

        $response = $obj->UpdateEntry('', 'test', 'test');
        $this->assertEquals(0, $response);
    }
}
