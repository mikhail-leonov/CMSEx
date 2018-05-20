<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(LIB . 'html.class.php');


use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testNothing()
    {
        $this->assertTrue(true);
    }
}
