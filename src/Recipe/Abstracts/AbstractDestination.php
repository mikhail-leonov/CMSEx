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
abstract class AbstractDestination implements \Recipe\Interfaces\DestinationInterface
{
    abstract public function put($data, $keys, $settings);
}
