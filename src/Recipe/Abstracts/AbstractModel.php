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

use \Recipe\Utils\Db;

/**
 * This is the "Base model class". All other "real" models extend this class.
 */
class AbstractModel implements \Recipe\Interfaces\ModelInterface
{
    /**
     * @var null Database Connection
     */
    public $db = null;

    /**
     * Whenever a model is created, we get the same database connection - i.e. DB Singelton.
     *
     * @return void
    */
    public function __construct()
    {
	$this->db = Db::GetInstance();
    }
}
