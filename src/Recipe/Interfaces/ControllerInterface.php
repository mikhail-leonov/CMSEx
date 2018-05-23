<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Interfaces;

/**
 * This is the "basic controller interface".
 */
interface ControllerInterface
{
    /**
     * Set Controller name
     *
     * @return void
     */
    public function setControllerName();
}

