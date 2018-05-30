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
use \Klein\DataCollection\DataCollection;
use \Recipe\Utils\Util;
use \Recipe\Factories\ModelFactory;
use \Recipe\Factories\DecoratorFactory;
use \Recipe\Abstracts\AbstractApiController;
use \Recipe\Abstracts\AbstractDecorator;

/**
 * Class Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ApiController extends AbstractApiController
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
        $this->name = "api";
    }

    /**
     * PAGE: api/SelectTag
     * This method handles what happens when you move to http://yourproject/api/SelectTag
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function SelectTag(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }

    /**
     * PAGE: api/UnselectTag
     * This method handles what happens when you move to http://yourproject/api/UnselectTag
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function UnselectTag(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }

    /**
     * PAGE: api/AddTag
     * This method handles what happens when you move to http://yourproject/api/AddTag
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function AddTag(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }

    /**
     * PAGE: api/DelTag
     * This method handles what happens when you move to http://yourproject/api/DelTag
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function DelTag(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }

    /**
     * PAGE: api/NewTag
     * This method handles what happens when you move to http://yourproject/api/NewTag
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function NewTag(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }

    /**
     * PAGE: api/FindTags
     * This method handles what happens when you move to http://yourproject/api/FindTags
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function FindTags(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }

    /**
     * PAGE: api/AssignTags
     * This method handles what happens when you move to http://yourproject/api/AssignTags
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function AssignTags(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }
    
    /**
     * PAGE: api/SaveEntry
     * This method handles what happens when you move to http://yourproject/api/SaveEntry
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function SaveEntry(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }
    
    /**
     * PAGE: api/SaveNewEntry
     * This method handles what happens when you move to http://yourproject/api/SaveNewEntry
     *
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function SaveNewEntry(Request $request) : string
    {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, "api", __FUNCTION__);
    }
}
