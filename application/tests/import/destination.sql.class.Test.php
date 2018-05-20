<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'destination.sql.class.php');


use PHPUnit\Framework\TestCase;

class SQLDestinationTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new SQLDestination();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SQLDestination::class, $obj);

        $obj = DestinationFactory::build("sql");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SQLDestination::class, $obj);
    }

}
