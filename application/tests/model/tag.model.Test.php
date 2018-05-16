<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'tag.model.php');


use PHPUnit\Framework\TestCase;

class TagModelTest extends TestCase
{
    public function testInstance()
    {
	$obj = new TagModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(TagModel::class, $obj);
    }

    public function testgetTags()
    {
	$obj = new TagModel();
	$tags = $obj->getTags();
	$this->assertInternalType('array', $tags);
        $this->assertGreaterThan(0, count($tags));
    }

    public function testgetEntryTags()
    {
	$obj = new TagModel();
	$tags = $obj->getEntryTags('0');
	$this->assertInternalType('array', $tags);
        $this->assertEquals(0, count($tags));

	$tags = $obj->getEntryTags('1');
	$this->assertInternalType('array', $tags);
        $this->assertGreaterThan(0, count($tags));
    }

    public function testgetGroups()
    {
	$obj = new TagModel();
	$groups = $obj->getGroups();
	$this->assertInternalType('array', $groups);
        $this->assertGreaterThan(0, count($groups));
    }

}
