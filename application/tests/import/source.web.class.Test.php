<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'source.web.class.php');


use PHPUnit\Framework\TestCase;

class WebSourceTest extends TestCase
{
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}

