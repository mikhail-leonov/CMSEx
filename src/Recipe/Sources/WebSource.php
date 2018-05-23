<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Sources;

/**
 * This is the "WEB Source data source class".
 */
class WebSource extends AbstractSource
{
    public function get($settings)
    {
        $result = "";
        $url = Util::GetCData($settings, 'sourceUrl', "");
        if ('' !== $url) {
            $result = file_get_contents($url);
        }
        return $result;
    }
}
