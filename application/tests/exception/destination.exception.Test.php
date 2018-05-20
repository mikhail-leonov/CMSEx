<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(EXCEPTION . 'Destination.exception.php');


use PHPUnit\Framework\TestCase;

class DestinationNotFoundExceptionTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    /**
      * @expectedException DestinationNotFoundException
      */
    public function testException()
    {
        throw new DestinationNotFoundException('', '');
    }

    public function testExceptionMessage()
    {
        $this->expectExceptionMessage('Destination [test] is not found in file: file.');
        throw new DestinationNotFoundException('test', 'file');
    }
}
