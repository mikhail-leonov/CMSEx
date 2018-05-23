<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Exceptions;

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
