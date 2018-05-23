<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Destinations;

/**
 * This is the "SQL Destination data source class".
 */
class SqlDestination extends AbstractDestination
{
    public function put($data, $keys, $settings)
    {
        $cfg = [
                'host' => Util::GetCData($settings, 'destinationHost', ""),
                'user' => Util::GetCData($settings, 'destinationUser', ""),
                'pass' => Util::GetCData($settings, 'destinationPass', ""),
                'name' => Util::GetCData($settings, 'destinationDB', ""),
                'code' => Util::GetCData($settings, 'destinationEncoding', ""),
        ];
        $table = Util::GetCData($settings, 'destinationTable', "");

        $fields = [];
        $where = [];
        foreach ($data as $idx => $item) {
            $key_idx = Util::GetCData($keys, "key_{$idx}", "false");
            if ('true' === $key_idx) {
                $where[$idx] = $item;
            }
            if ('' !== trim($item)) {
                $fields[$idx] = $item;
            }
        }
        $db = DB::instance();
        $db->connect($cfg);

        $entry = $db->select("*")->from($table)->where($where)->first();
        if (false !== $entry) {
            $db->update($fields)->into($table)->where($where)->exec();
        } else {
            $db->insert($fields)->into($table)->exec();
        }
    }
}
