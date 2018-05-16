<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
require_once(MODEL . 'recipe.model.php');


use PHPUnit\Framework\TestCase;

class RecipeModelTest extends TestCase
{
    public function testInstance()
    {
	$obj = new RecipeModel();
        $this->assertNotEmpty($obj);
	$this->assertInstanceOf(RecipeModel::class, $obj);
    }

    public function testgetRecipies()
    {
	$obj = new RecipeModel();
	$recepies = $obj->getRecipies();

	$this->assertInternalType('array', $recepies);
        $this->assertEquals(0, count($recepies));
    }

    public function testsearchRecipies()
    {
	$obj = new RecipeModel();
	$recepies = $obj->searchRecipies([]);
	$this->assertInternalType('array', $recepies);
        $this->assertEquals(0, count($recepies));

	$recepies = $obj->searchRecipies(['q' => 'Ростбиф']);
	$this->assertInternalType('array', $recepies);
        $this->assertGreaterThan(0, count($recepies));
    }
}
