<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(IMPORT . 'source.sql.class.php');


use PHPUnit\Framework\TestCase;

class SQLSourceTest extends TestCase
{
    public function testNothing()
    {
        $this->assertTrue(true);
    }
}

