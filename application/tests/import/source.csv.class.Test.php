<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'source.csv.class.php');


use PHPUnit\Framework\TestCase;

class CSVSourceTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new CSVsource();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(CSVsource::class, $obj);

        $obj = sourceFactory::build("csv");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(CSVsource::class, $obj);
    }

}
