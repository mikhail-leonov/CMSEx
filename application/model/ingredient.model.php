<?php
/**
 * Abstract controller
 */
require_once( MODEL . 'abstract.model.php' );

/**
 * Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class IngredientModel extends AbstractModel
{
    /**
     * Get all selected/grouped not selected tags from tags Table 
     */
    public function getIngredients()
    {
	$result = array();
	return $result;
    }
    /**
     * Get all tags for entry 
     */
    public function getEntryIngredients($entry_id)
    {
	$result = array();
	return $result;
    }
}
