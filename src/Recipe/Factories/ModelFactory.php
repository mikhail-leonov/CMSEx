<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Factories;

/**
 * This is the "Model factory class".
 * Extends AbstractFactory implements IModelFactory
 */
class ModelFactory extends AbstractFactory implements ModelFactoryInterface
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
