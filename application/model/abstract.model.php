<?php
/**
 * Include section
 */
require_once(LIB . 'abstractobject.class.php');

/**
 * This is the "Model interface".
 */
interface IModel
{
}


/**
 * This is the "Base model class". All other "real" models extend this class.
 */
class AbstractModel extends AbstractObject implements IModel
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
        $this->db = DB::instance();
    }
}
