<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'destination.web.class.php');

use PHPUnit\Framework\TestCase;

class WebDestinationTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new WebDestination();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(WebDestination::class, $obj);

        $obj = DestinationFactory::build("web");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(WebDestination::class, $obj);
    }

}
