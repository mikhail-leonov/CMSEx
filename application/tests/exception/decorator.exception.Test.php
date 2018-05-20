<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(EXCEPTION . 'decorator.exception.php');


use PHPUnit\Framework\TestCase;

class DecoratorNotFoundExceptionTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    /**
      * @expectedException DecoratorNotFoundException
      */
    public function testException()
    {
        throw new DecoratorNotFoundException('', '');
    }

    public function testExceptionMessage()
    {
        $this->expectExceptionMessage('Decorator [test] is not found in file: file.');
        throw new DecoratorNotFoundException('test', 'file');
    }
}
