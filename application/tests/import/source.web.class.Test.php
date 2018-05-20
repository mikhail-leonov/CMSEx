<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(IMPORT . 'source.web.class.php');


use PHPUnit\Framework\TestCase;

class WebSourceTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;
    
    public function testInstance()
    {
        $obj = new Websource();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(Websource::class, $obj);

        $obj = sourceFactory::build("web");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(Websource::class, $obj);
    }

}
