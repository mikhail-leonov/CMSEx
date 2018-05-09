<?php

/**
 * Include section
 */
require_once( VIEW . 'abstract.view.php' );

/**
 * This is the "Page View class".
 */
class PageView extends AbstractView
{
    /**
     * The idea behind is to have ONE View.
     */
    public function __construct($name)
    {
        parent::__construct($name);
	$this->dir = "pages";
    }

}