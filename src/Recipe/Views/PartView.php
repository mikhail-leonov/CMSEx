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

use \Recipe\Exceptions\ViewNotFoundException;

/**
 * This is the "Parts View class".
 */
class PartView extends \Recipe\Abstracts\AbstractView implements \Recipe\Interfaces\ViewInterface
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

	$this->VIEW = $this->VIEW . "Widgets" . DIRECTORY_SEPARATOR ; 
        $this->smarty->setTemplateDir($this->VIEW);

        $templateName = $this->VIEW . $this->name . ".html";
        if (!$this->smarty->templateExists($templateName)) {
            throw new ViewNotFoundException($this->name, $templateName);
        }
    }
}
