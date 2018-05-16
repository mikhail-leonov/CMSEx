<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'destination.sql.class.php');


use PHPUnit\Framework\TestCase;

class SQLDestinationTest extends TestCase
{
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}

