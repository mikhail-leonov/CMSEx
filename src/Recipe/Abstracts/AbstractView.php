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
 * This is the "base view class". All other "real" views extend this class.
 */
abstract class AbstractView implements \Recipe\Interfaces\ViewInterface
{
    /**
     * @var '' Template Directory
     */
    protected $VIEW = '';

    /**
     * @var '' Template Name to display
     */
    protected $name = '';

    /**
     * @var '' Template Dir to display
     */
    protected $dir = '';

    /**
     * @var null Smarty object
     */
    protected $smarty = null;

    /**
     * Constructor
     *
     * @var array $name View name
     *
     * @return void
     */
    public function __construct(string $name)
    {
        $this->dir = '';
        $this->name = $name;
        $this->smarty = new \Smarty();
	$this->VIEW = dirname(__DIR__) . DIRECTORY_SEPARATOR . "Views" . DIRECTORY_SEPARATOR . "Templates" . DIRECTORY_SEPARATOR ; 
        $this->smarty->setTemplateDir($this->VIEW);
        $tmpDir = TEMP . "templates_c/$name";
        if (!file_exists($tmpDir)) {
            mkdir($tmpDir, 0777, true);
        }
        $this->smarty->setCompileDir($tmpDir);
        $this->smarty->force_compile = DEBUG;
        $this->smarty->debugging = false;
    }
    
    /**
     * Assign parameter to smarty object
     *
     * @var array $name parameter name
     *
     * @var any $value parameter value
     *
     * @return void
     */
    public function assign(string $name, $value)
    {
        $this->smarty->assign($name, $value);
    }

    /**
     * Fetch smarty template as a string
     *
     * @return string
     */
    public function fetch() : string
    {
        $result = "";
        $templateName = $this->VIEW . $this->name . ".html";
        if ($this->smarty->templateExists($templateName)) {
            $result = $this->smarty->fetch($templateName);
        } else {
           throw new ViewNotFoundException($this->name, $templateName);
	}
        return $result;
    }

    /**
     * Display smarty template as a string
     *
     * @return void
     */
    public function display()
    {
        print($this->fetch());
    }
}
