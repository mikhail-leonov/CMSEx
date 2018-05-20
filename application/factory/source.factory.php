<?php

/**
 * Require Abstractfactory
 */
require_once(FACTORY . 'abstract.factory.php');
require_once(EXCEPTION . 'source.exception.php');

/**
 * This is the "SourceFactory interface".
 */
interface ISourceFactory
{
    /**
     * Method to build an Source object of $name type ISource
     *
     * @var string $name Source name to create
     *
     * @throws Exception if the provided name does not match existing php Source file
     *
     * @return ISource Source we have created
     */
    public static function build(string $name) : ISource;
}

/**
 * This is the "Source data source factory class".
 */
class SourceFactory extends AbstractFactory implements ISourceFactory
{
    /**
     * Method to build an Source object of $name type ISource
     *
     * @var string $name Source name to create
     *
     * @throws SourceNotFoundException if the provided name does not match existing php Source file
     *
     * @return ISource Source we have created
     */
    public static function build(string $name) : ISource
    {
        $sourceFileName = IMPORT . "source." . strtolower($name) . '.class.php';
        $source_name = ucfirst(strtolower($name)) . "Source";

        if (file_exists($sourceFileName)) {
            require_once($sourceFileName);
            return new $source_name();
        }
        throw new SourceNotFoundException($source_name, $sourceFileName);
    }
}
