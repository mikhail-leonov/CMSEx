<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Views;

/**
 * This is the "Page View class".
 */
class PageView extends \Recipe\Abstracts\AbstractView
{
    /**
     * Constructor
     *
     * @var array $name View name
     *
     * @throws ViewNotFoundException if the provided name does not match to any of existing php view files
     *
     * @return void
     */
    public function __construct(string $name)
    {
        parent::__construct($name);
        $this->dir = "pages";

        $templateName = VIEW . $this->dir . DS . $this->name . ".view.html";
        if (!$this->smarty->templateExists($templateName)) {
            throw new ViewNotFoundException($this->name, $templateName);
        }
    }
}
