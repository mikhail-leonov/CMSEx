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
class DestinationFactory extends AbstractFactory implements DestinationFactoryInterface
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
        $destinationFileName = IMPORT . "destination." . strtolower($name) . '.class.php';
        $destination_name = ucfirst(strtolower($name)) . "Destination";

        if (file_exists($destinationFileName)) {
            require_once($destinationFileName);
            return new $destination_name();
        }
        throw new DestinationNotFoundException($destination_name, $destinationFileName);
    }
}
