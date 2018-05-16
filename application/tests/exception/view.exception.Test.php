<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(EXCEPTION . 'view.exception.php');


use PHPUnit\Framework\TestCase;

class ViewNotFoundExceptionTest extends TestCase
{
   /**
     * @expectedException ViewNotFoundException
     */
    public function testException()
    {
        throw new ViewNotFoundException('', '');
    }

    public function testExceptionMessage()
    {
        $this->expectExceptionMessage('View [test] is not found in file: file.');
        throw new ViewNotFoundException('test', 'file');
    }
}
