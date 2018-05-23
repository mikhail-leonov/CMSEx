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
class ModelFactory extends \Recipe\Abstracts\AbstractFactory implements \Recipe\Interfaces\ModelFactoryInterface
{
    /**
     * Method to build an Model object of $name type ModelInterface
     *
     * @var string $name Modelname to create
     *
     * @throws ModelNotFoundException if the provided name does not match to any of existing php model files
     *
     * @return IModel Model we have created
     */
    public static function build(string $name) : \Recipe\Interfaces\ModelInterface
    {
        $className = "\\Recipe\\Models\\" . ucfirst(strtolower($name)) . "Model";
        return new $className();
    }
}
