<?php

/**
 * Include section
 */
require_once( VIEW . 'abstract.view.php' );

/**
 * This is the "Parts View class". 
 */
class PartView extends AbstractView
{
    /**
     * The idea behind is to have ONE View.
     */
    public function __construct($name)
    {
        parent::__construct($name);
	$this->dir = "parts";
    }
    
}