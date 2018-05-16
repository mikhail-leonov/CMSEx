<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'destination.dbf.class.php');


use PHPUnit\Framework\TestCase;

class DBFDestinationTest extends TestCase
{
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}

