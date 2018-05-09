<?php

/**
 * Include section
 */
require_once( LIB . 'abstractobject.class.php' );
require_once( SMARTY . 'Smarty.class.php' );

/**
 * This is the "base view class". All other "real" views extend this class.
 */
abstract class AbstractView extends AbstractObject
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
     * The idea behind is to have ONE View.
     */
    public function __construct($name)
    {
	$this->dir = '';
        $this->name = $name;
	$this->smarty = new Smarty();
	$this->smarty->setTemplateDir( VIEW );
        $tmpDir = TEMP . "templates_c/$name"; 
	if (!file_exists($tmpDir)) {
	    mkdir($tmpDir); 
	}
        $this->smarty->setCompileDir($tmpDir);
	$this->smarty->force_compile = DEBUG;
	$this->smarty->debugging = false;
    }
    
    /**
     * Assign($name, $value)
     */
    public function assign($name, $value)
    {
	$this->smarty->assign($name, $value);
    }

    /**
     * Fetch()
     */
    public function fetch()
    {
	$result = "";
	$templateName = VIEW . $this->dir . DS . $this->name . ".view.html";
        if ( $this->smarty->templateExists( $templateName ) ) {
       		$result = $this->smarty->fetch( $templateName );
	}
	return $result;
    }

    /**
     * Display()
     */
    public function display()
    {
	print( $this->fetch() );
    }


 


}