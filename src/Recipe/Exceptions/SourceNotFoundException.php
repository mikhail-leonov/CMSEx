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
