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
 * This is the "View File Not Found Exception class".
 */
class PartViewNotFoundException extends AbstractException
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
        parent::__construct("View [{$name}] is not found in file: {$fileName}.");
    }
}
