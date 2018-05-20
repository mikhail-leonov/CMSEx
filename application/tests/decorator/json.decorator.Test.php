<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(DECORATOR . 'json.decorator.php');


use PHPUnit\Framework\TestCase;

class JsonDecoratorTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstatiating()
    {
        $decorator = DecoratorFactory::build("json");
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(JsonDecorator::class, $decorator);

        $decorator = new JsonDecorator();
        $this->assertNotEmpty($decorator);
        $this->assertInstanceOf(JsonDecorator::class, $decorator);
    
        $response = $decorator->Decorate((object)[]);
        $this->assertNotEmpty($response);
        $this->assertInternalType('string', $response);
        
        $response = $decorator->Decorate((object)['result' => 0, 'data' => (object)[] ]);
        $this->assertNegativeJsonResponse($response);

        $response = $decorator->Decorate((object)['result' => 1, 'data' => (object)[] ]);
        $this->assertPositiveJsonResponse($response);
    }
}
