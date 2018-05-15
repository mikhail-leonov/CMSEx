<?php
/**
 * Require Abstractfactory
 */
require_once(FACTORY . 'abstract.factory.php');
require_once(EXCEPTION . 'model.exception.php');

/**
 * This is the "ModelFactory interface".
 */
interface IModelFactory
{
    /**
     * Method to build an Model object of $name type IModel
     * 
     * @var string $name Modelname to create
     * 
     * @throws Exception if the provided name does not match existing php model files
     * 
     * @return IModel Model we have created
     */
    public static function build(string $name) : IModel;
}

/**
 * This is the "Model factory class".
 * Extends AbstractFactory implements IModelFactory
 */
class ModelFactory extends AbstractFactory implements IModelFactory
{
    /**
     * Method to build an Model object of $name type IModel
     * 
     * @var string $name Modelname to create
     * 
     * @throws ModelNotFoundException if the provided name does not match to any of existing php model files
     * 
     * @return IModel Model we have created
     */
    public static function build(string $name) : IModel
    {
        $modelName = $name . "Model";
        $modelFileName = MODEL . strtolower($name) . '.model.php';
        if (file_exists($modelFileName)) {
            require_once($modelFileName);
            return new $modelName();
        }
        throw new ModelNotFoundException($modelName, $modelFileName);
    }
}