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

use Envms\FluentPDO\Query;

/**
 * This is the "DB Initialization class".
 */
class Db {
    /**
     * Constructor
     *
     * @var string $name Config file name
     *
     * @return FluentPDO|null DB access object
     */
    public function GetInstance(string $name = 'config.cfg' )
    {
	$result = null;
	if (file_exists($name)) {
	    $config = new Config($name);
	    $settings = $config->GetKeys('db');
	    if (!empty($settings)) {

                $dsn = "mysql:host={$settings['host']};dbname={$settings['name']};charset={$settings['char']}";
                $options = [ \PDO::ATTR_PERSISTENT => true ];
                $pdo = new \PDO($dsn, $settings['user'], $settings['pass'], $options);
                $result = new Query($pdo);
	    }
	}
	return $result;
    }
}