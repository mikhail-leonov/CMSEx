<?php
/**
 * Recipe - A recipe manager
 *
 * @author      Mikhail Leonov <mikecommon@gmail.com>
 * @copyright   (c) Mikhail Leonov
 * @link        https://github.com/mikhail-leonov/recipe
 * @license     MIT
 */

namespace Recipe\Controllers;

use \Klein\DataCollection\DataCollection;
use \Klein\Request;
use \Recipe\Abstracts\AbstractApiController;
use \Recipe\Factories\PageViewFactory;
use \Recipe\Factories\PartViewFactory;
use \Recipe\Factories\ModelFactory;
use \Recipe\Models;
use \Recipe\Views;
use \Recipe\Utils\Util;

/**
 * Class Entry Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryApiController extends AbstractApiController
{
    /**
     * Constructor
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Implementation AbstractController setControllerName function - Whenever a controller is created, we set it's name
     *
     * @return void
     */
    public function setControllerName()
    {
        $this->name = "entry";
    }

    /**
     * getEntries - Returns all Entries 
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getEntries(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * postEntries - Create a new Entries
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function postEntries(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * putEntries - Bulk update of Entries
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function putEntries(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * deleteEntries - Delete all Entries
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function deleteEntries(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * getEntry - Return a specified Entries
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getEntry(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * postEntry - Not allowed
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function postEntry(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * putEntry - Update a specified Entries
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function putEntry(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * deleteEntry - Delete a specified Entries
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function deleteEntry(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
}
