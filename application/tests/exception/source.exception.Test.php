<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(EXCEPTION . 'Source.exception.php');


use PHPUnit\Framework\TestCase;

class SourceNotFoundExceptionTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    /**
      * @expectedException SourceNotFoundException
      */
    public function testException()
    {
        throw new SourceNotFoundException('', '');
    }

    public function testExceptionMessage()
    {
        $this->expectExceptionMessage('Source [test] is not found in file: file.');
        throw new SourceNotFoundException('test', 'file');
    }
}
