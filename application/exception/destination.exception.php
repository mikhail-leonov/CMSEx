<?php
/**
 * Include section
 */
require_once(EXCEPTION . 'abstract.exception.php');

/**
 * This is the "Destination File Not Found Exception class".
 */
class DestinationNotFoundException extends AbstractException
{
    /**
     * Constructor
     *
     * @var string $name Destination Class Name
     *
     * @var string $filename Destination Class File Name
     *
     * @return void
     */
    public function __construct($name, $fileName)
    {
        parent::__construct("Destination [{$name}] is not found in file: {$fileName}.");
    }
}
