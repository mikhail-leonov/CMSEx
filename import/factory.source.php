<?php

/**
 * Require Abstractfactory
 */
require_once(FACTORY . 'abstract.factory.php');


/**
 * This is the "Source data source factory class".
 */
class SourceFactory extends AbstractFactory
{
    /**
     * Method to build an Destination data source object of $name type ISource
     */
    public static function build(string $name) : ISource
    {
        $sourceFileName = IMPORT . "source." . strtolower($name) . '.class.php';
        $source_name = ucfirst(strtolower($name)) . "Source";

        if (file_exists($sourceFileName)) {
            require_once($sourceFileName);
            return new $source_name();
        }
        throw new Exception("Source [{$source_name}] file is not found: {$sourceFileName}.");
    }
}
