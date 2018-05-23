<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Interfaces;

/**
 * This is the "ModelFactory interface".
 */
interface ModelFactoryInterface
{
    /**
     * Method to build an Model object of $name type \Recipe\Interfaces\ModelInterface;
     *
     * @var string $name Modelname to create
     *
     * @throws Exception if the provided name does not match existing php model files
     *
     * @return IModel Model we have created
     */
    public static function build(string $name) : \Recipe\Interfaces\ModelInterface;
}
