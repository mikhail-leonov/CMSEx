<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Factories;

/**
 * This is the "SourceFactory interface".
 */
interface SourceFactoryInterface
{
    /**
     * Method to build an Source object of $name type ISource
     *
     * @var string $name Source name to create
     *
     * @throws Exception if the provided name does not match existing php Source file
     *
     * @return ISource Source we have created
     */
    public static function build(string $name) : ISource;
}
