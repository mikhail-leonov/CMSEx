<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'destination.dbf.class.php');


use PHPUnit\Framework\TestCase;

class DBFDestinationTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new DBFDestination();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DBFDestination::class, $obj);

        $obj = DestinationFactory::build("dbf");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(DBFDestination::class, $obj);
    }

}
