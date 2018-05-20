<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(MODEL . 'tag.model.php');


use PHPUnit\Framework\TestCase;

class TagModelTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new TagModel();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(TagModel::class, $obj);
        
        $obj = ModelFactory::build("tag");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(TagModel::class, $obj);
    }

    public function testGetTags()
    {
        $methodName = "getTags";
        $obj = new TagModel();
        $this->assertClassMethodExist('TagModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);
        
        $tags = $obj->getTags();
        $this->assertInternalType('array', $tags);
        $this->assertGreaterThan(0, count($tags));
    }

    public function testGetEntryTags()
    {
        $methodName = "getEntryTags";
        $obj = new TagModel();
        $this->assertClassMethodExist('TagModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $tags = $obj->getEntryTags('0');
        $this->assertInternalType('array', $tags);
        $this->assertEquals(0, count($tags));

        $tags = $obj->getEntryTags('1');
        $this->assertInternalType('array', $tags);
        $this->assertGreaterThan(0, count($tags));
    }

    public function testGetGroups()
    {
        $methodName = "getGroups";
        $obj = new TagModel();
        $this->assertClassMethodExist('TagModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $groups = $obj->getGroups();
        $this->assertInternalType('array', $groups);
        $this->assertGreaterThan(0, count($groups));
    }

    public function testGetSelectedTags()
    {
        $methodName = "getSelectedTags";
        $obj = new TagModel();
        $this->assertClassMethodExist('TagModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $groups = $obj->getSelectedTags();
        $this->assertInternalType('array', $groups);
        $this->assertEquals(0, count($groups));
    }

}
