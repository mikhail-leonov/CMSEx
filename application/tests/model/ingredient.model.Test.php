<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(MODEL . 'ingredient.model.php ');


use PHPUnit\Framework\TestCase;

class IngredientModelTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new IngredientModel();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(IngredientModel::class, $obj);
        
        $obj = ModelFactory::build("ingredient");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(IngredientModel::class, $obj);
    }

    public function testgetIngredients()
    {
        $methodName = "getIngredients";
        $obj = new IngredientModel();
        $this->assertClassMethodExist('IngredientModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $objs = $obj->getIngredients();
        $this->assertInternalType('array', $objs);
        $this->assertEquals(0, count($objs));
    }

    public function testgetEntryIngredients()
    {
        $methodName = "getEntryIngredients";
        $obj = new IngredientModel();
        $this->assertClassMethodExist('IngredientModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $objs = $obj->getEntryIngredients(0);
        $this->assertInternalType('array', $objs);
        $this->assertEquals(0, count($objs));
    }
}
