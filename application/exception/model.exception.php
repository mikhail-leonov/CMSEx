<?php
/**
 * Include section
 */
require_once(EXCEPTION . 'abstract.exception.php');

/**
 * This is the "Model File Not Found Exception class". 
 */
class ModelNotFoundException extends AbstractException
{
    /**
     * Constructor 
     * 
     * @var string $name Model Class Name
     * 
     * @var string $filename Model Class File Name
     * 
     * @return void
     */
    public function __construct($name, $fileName)
    {
        parent::__construct("Model [{$name}] is not found in file: {$fileName}.");
    }

	
}
