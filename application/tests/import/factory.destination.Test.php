<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'factory.destination.php');


use PHPUnit\Framework\TestCase;

class FactoryDestinationTest extends TestCase
{
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}

