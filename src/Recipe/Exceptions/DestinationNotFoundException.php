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
