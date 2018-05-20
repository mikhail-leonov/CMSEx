<?php
/**
 * Include section
 */
require_once(EXCEPTION . 'abstract.exception.php');

/**
 * This is the "Source File Not Found Exception class".
 */
class SourceNotFoundException extends AbstractException
{
    /**
     * Constructor
     *
     * @var string $name Source Class Name
     *
     * @var string $filename Source Class File Name
     *
     * @return void
     */
    public function __construct($name, $fileName)
    {
        parent::__construct("Source [{$name}] is not found in file: {$fileName}.");
    }
}
