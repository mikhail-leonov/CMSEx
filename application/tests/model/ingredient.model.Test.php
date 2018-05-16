<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'ingredient.model.php ');


use PHPUnit\Framework\TestCase;

class IngredientModelTest extends TestCase
{
    public function testInstance()
    {
	$obj = new IngredientModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(IngredientModel::class, $obj);
    }

    public function testgetIngredients()
    {
	$obj = new IngredientModel();
	$objs = $obj->getIngredients();

	$this->assertInternalType('array', $objs);
        $this->assertEquals(0, count($objs));
    }

    public function testgetEntryIngredients()
    {
	$obj = new IngredientModel();
	$objs = $obj->getEntryIngredients(0);

	$this->assertInternalType('array', $objs);
        $this->assertEquals(0, count($objs));
    }

}
