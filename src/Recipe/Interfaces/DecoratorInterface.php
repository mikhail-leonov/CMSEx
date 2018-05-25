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
 * This is the "basic decorator interface".
 */
interface DecoratorInterface
{
    /**
     * Decorate
     *
     * @var stdClass $obj parameters
     *
     * @return string decorated Object
     */
    public function Decorate(stdClass $obj) : string;
}

