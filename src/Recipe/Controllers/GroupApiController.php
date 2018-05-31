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

use \Klein\Request;
use \Recipe\Utils\Util;
use \Klein\DataCollection\DataCollection;
use \Recipe\Abstracts\AbstractApiController;
use \Recipe\Factories;
use \Recipe\Models;

/**
 * Class Group Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class GroupApiController extends AbstractApiController
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
        $this->name = "group";
    }

    /**
     * getGroups - Returns all groups 
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getGroups(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * postGroups - Create a new groups
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function postGroups(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * putGroups - Bulk update of groups
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function putGroups(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * deleteGroups - Delete all groups
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function deleteGroups(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * getGroup - Return a specified groups
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getGroup(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * postGroup - Not allowed
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function postGroup(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * putGroup - Update a specified groups
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function putGroup(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * deleteGroup - Delete a specified groups
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function deleteGroup(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
}
