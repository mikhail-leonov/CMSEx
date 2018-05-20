<?php

/**
 * Require Abstractfactory
 */
require_once(FACTORY . 'abstract.factory.php');
require_once(EXCEPTION . 'destination.exception.php');

/**
 * This is the "DestinationFactory interface".
 */
interface IDestinationFactory
{
    /**
     * Method to build an Destination object of $name type IDestination
     *
     * @var string $name Destination name to create
     *
     * @throws Exception if the provided name does not match existing php Destination file
     *
     * @return IDestination Destination we have created
     */
    public static function build(string $name) : IDestination;
}

/**
 * This is the "Destination data source factory class".
 */
class DestinationFactory extends AbstractFactory implements IDestinationFactory
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
