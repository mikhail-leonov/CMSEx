<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(DECORATOR . 'array.decorator.php');


use PHPUnit\Framework\TestCase;

class ArrayDecoratorTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $decorator = DecoratorFactory::build("array");
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(ArrayDecorator::class, $decorator);

        $decorator = new ArrayDecorator();
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(ArrayDecorator::class, $decorator);
    
        $response = $decorator->Decorate((object)[]);
        $this->assertNotEmpty($response);
        $this->assertInternalType('string', $response);
    }
}
