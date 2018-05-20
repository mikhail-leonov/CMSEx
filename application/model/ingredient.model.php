<?php
/**
 * Include section
 */
require_once(MODEL . 'abstract.model.php');

/**
 * Ingridient Model
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class IngredientModel extends AbstractModel
{
    /**
     * Get list of all ingridients
     *
     * @return array
     */
    public function getIngredients() : array
    {
        $result = [];
        return $result;
    }
    /**
     * Get list of entry ingridients by entry_id
     *
     * @var string $entry_id
     *
     * @return array
     */
    public function getEntryIngredients(string $entry_id) : array
    {
        $result = [];
        return $result;
    }
}
