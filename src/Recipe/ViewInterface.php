<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe;

/**
 * This is the "View interface".
 */
interface ViewInterface
{
    public function __construct(string $name);
    public function assign(string $name, $value);
    public function fetch() : string;
    public function display();
}

