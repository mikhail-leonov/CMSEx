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
 * This is the "Destination data source factory class".
 */
class DestinationFactory extends \Recipe\Abstracts\AbstractFactory implements \Recipe\Interfaces\DestinationFactoryInterface
{
    /**
     * Method to build an Destination object of $name type IDestination
     *
     * @var string $name Destination name to create
     *
     * @throws DestinationNotFoundException if the provided name does not match existing php Destination file
     *
     * @return IDestination Destination we have created
     */
    public static function build(string $name) : IDestination
    {
        $className = "\\Recipe\\Destinations\\" . ucfirst(strtolower($name)) . "Destination";
        return new $className();
    }
}
