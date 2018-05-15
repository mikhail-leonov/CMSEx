<?php
/**
 * Include section
 */
require_once(LIB . 'abstractobject.class.php');
require_once(SMARTY . 'Smarty.class.php');


/**
 * This is the "View interface".
 */
interface IView
{
    public function __construct(string $name);
    public function assign(string $name, $value);
    public function fetch() : string;
    public function display();
}

/**
 * This is the "base view class". All other "real" views extend this class.
 */
abstract class AbstractView extends AbstractObject implements IView
{
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
        $this->smarty = new Smarty();
        $this->smarty->setTemplateDir(VIEW);
        $tmpDir = TEMP . "templates_c/$name";
        if (!file_exists($tmpDir)) {
            mkdir($tmpDir);
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
        $templateName = VIEW . $this->dir . DS . $this->name . ".view.html";
        if ($this->smarty->templateExists($templateName)) {
            $result = $this->smarty->fetch($templateName);
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
