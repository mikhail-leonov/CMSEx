<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(DECORATOR . 'xml.decorator.php');


use PHPUnit\Framework\TestCase;

class XmlDecoratorTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $decorator = DecoratorFactory::build("xml");
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(XmlDecorator::class, $decorator);

        $decorator = new XmlDecorator();
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(XmlDecorator::class, $decorator);
    
        $response = $decorator->Decorate((object)[]);
        $this->assertNotEmpty($response);
        $this->assertInternalType('string', $response);
        
        $response = $decorator->Decorate((object)['result' => 0, 'data' => (object)[] ]);
        $this->assertNegativeXmlResponse($response);

        $response = $decorator->Decorate((object)['result' => 1, 'data' => (object)[] ]);
        $this->assertPositiveXmlResponse($response);
    }
}
