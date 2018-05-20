<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'source.dbf.class.php');


use PHPUnit\Framework\TestCase;

class DBFSourceTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new DBFsource();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DBFsource::class, $obj);

        $obj = sourceFactory::build("dbf");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DBFsource::class, $obj);
    }

}
