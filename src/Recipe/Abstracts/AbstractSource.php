<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */
 
namespace Recipe\Abstracts;

/**
 * This is the "Abstract Destination data source class".
 */
abstract class AbstractSource implements \Recipe\Interfaces\SourceInterface
{
    abstract public function get($settings);
}
