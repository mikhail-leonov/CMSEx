<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(EXCEPTION . 'model.exception.php');


use PHPUnit\Framework\TestCase;

class ModelNotFoundExceptionTest extends TestCase
{
   /**
     * @expectedException ModelNotFoundException
     */
    public function testException()
    {
        throw new ModelNotFoundException('', '');
    }

    public function testExceptionMessage()
    {
        $this->expectExceptionMessage('Model [test] is not found in file: file.');
        throw new ModelNotFoundException('test', 'file');
    }
}
