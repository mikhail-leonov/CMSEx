<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(EXCEPTION . 'model.exception.php');


use PHPUnit\Framework\TestCase;

class ModelNotFoundExceptionTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

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
