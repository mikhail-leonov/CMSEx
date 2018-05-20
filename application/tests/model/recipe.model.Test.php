<?php
include_once(dirname(dirname(dirname(dirname(__FILE__)))) . '/index.const');
include_once(dirname(dirname(__FILE__)) . '/TestCaseEx.php');
require_once(MODEL . 'recipe.model.php');


use PHPUnit\Framework\TestCase;

class RecipeModelTest extends TestCase
{
    /**
     * TestCase class extention Trait
     *
     */
    use TestCaseEx;

    public function testInstance()
    {
        $obj = new RecipeModel();
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(RecipeModel::class, $obj);
        
        $obj = ModelFactory::build("recipe");
        $this->assertNotEmpty($obj);
        $this->assertInstanceOf(RecipeModel::class, $obj);
    }

    public function testGetRecipies()
    {
        $methodName = "getRecipies";
        $obj = new RecipeModel();
        $this->assertClassMethodExist('RecipeModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $recepies = $obj->getRecipies();
        $this->assertInternalType('array', $recepies);
        $this->assertEquals(0, count($recepies));
    }

    public function testSearchRecipies()
    {
        $methodName = "searchRecipies";
        $obj = new RecipeModel();
        $this->assertClassMethodExist('RecipeModel', $methodName);
        $this->assertObjectMethodExist($obj, $methodName);

        $recepies = $obj->searchRecipies([]);
        $this->assertInternalType('array', $recepies);
        $this->assertEquals(0, count($recepies));

        $recepies = $obj->searchRecipies(['q' => 'Стейк']);
        $this->assertInternalType('array', $recepies);
        $this->assertGreaterThan(0, count($recepies));
    }
}
