<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(DECORATOR . 'null.decorator.php');


use PHPUnit\Framework\TestCase;

class NullDecoratorTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $decorator = DecoratorFactory::build("null");
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(NullDecorator::class, $decorator);

        $decorator = new NullDecorator();
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(NullDecorator::class, $decorator);
    
        $response = $decorator->Decorate((object)[]);
        $this->assertNotEmpty($response);
        $this->assertInternalType('string', $response);
    }
}
