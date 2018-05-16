<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'factory.source.php');


use PHPUnit\Framework\TestCase;

class FactorySourceTest extends TestCase
{
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
