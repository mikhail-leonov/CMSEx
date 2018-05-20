<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'source.sql.class.php');


use PHPUnit\Framework\TestCase;

class SQLSourceTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new SQLsource();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SQLsource::class, $obj);

        $obj = sourceFactory::build("sql");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(SQLsource::class, $obj);
    }

}
