<?php
/**
 * Include section
 */
require_once(EXCEPTION . 'abstract.exception.php');

/**
 * This is the "Decorator Not Found Exception class".
 */
class DecoratorNotFoundException extends AbstractException
{
    /**
     * Constructor
     *
     * @var string $name View Class Name
     *
     * @var string $filename View Class File Name
     *
     * @return void
     */
    public function __construct($name, $fileName)
    {
        parent::__construct("Decorator [{$name}] is not found in file: {$fileName}.");
    }
}
