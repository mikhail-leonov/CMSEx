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
 * Class Abstract Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 * This is the "base controller class". All other "real" controllers extend this class.
 */
abstract class AbstractController implements \Recipe\Interfaces\ControllerInterface
{
    /**
     * @var string|null Controller name
     */
    public $name = "";

    /**
     * Set Controller name inside constructor with overriden in child class setControllerName function
     *
     * @return void
     */
    public function __construct()
    {
        $this->setControllerName();
    }
    /**
     * Set Controller name
     *
     * @return void
     */
    abstract public function setControllerName();

    /**
     * Get PUT Parameters
     *
     * @return void
     */
    public function ParamsPut() : \stdClass 
    { 
    	$a_data = (object)[];
      	$input = file_get_contents('php://input');
      	preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
        if ($matches) {
            $boundary = $matches[1];
            $a_blocks = preg_split("/-+$boundary/", $input);
            array_pop($a_blocks);
        } else {
            parse_str($input, $a_blocks);
        }

        foreach ($a_blocks as $id => $block) {
            if (empty($block)) {
                continue;
            }
            if (strpos($block, 'application/octet-stream') !== FALSE) {
                preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
            } else {
                preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
            }
            if ($matches) {
                $a_data->{$matches[1]} = $matches[2];
            } else {
                $a_data->{$id} = $block;
            }
        }
        return $a_data;
    }
}