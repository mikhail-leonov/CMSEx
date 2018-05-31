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
use \Recipe\Factories\ModelFactory;
use \Recipe\Factories\DecoratorFactory;

/**
 * Class Tag Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class TagApiController extends AbstractApiController
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
        $this->name = "tag";
    }

    /**
     * 
     * Basic Tags operations
     * 
     */


    /**
     * getTags - Returns all Tags 
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * postTags - Create a new Tags
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function postTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, "tag", __FUNCTION__);
    }
    /**
     * putTags - Bulk update of Tags
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function putTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * deleteTags - Delete all Tags
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function deleteTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * getTag - Return a specified Tags
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getTag(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * postTag - Not allowed
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function postTag(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * putTag - Update a specified Tags
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function putTag(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * deleteTag - Delete a specified Tags
     * 
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function deleteTag(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }




    /**
     * 
     * Basic Entry Tags operations
     * 
     */


    /**
     * entryTagSelect
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function tagSelect(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }

    /**
     * entryTagUnselect
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function tagUnselect(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * getEntryTags
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function getEntryTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }

    /**
     * searchEntryTags
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function searchEntryTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }

    /**
     * assignEntryTags
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function assignEntryTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    /**
     * attachTagToEntry
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function attachTagToEntry(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsPut());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }

    /**
     * detachTagFromEntry
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function detachTagFromEntry(Request $request) : string {
        $params = $this->MergedRequestParams($request, Util::paramsDelete());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }




    /**
     * PAGE: api/NewTag
     * This method handles what happens when you move to http://yourproject/api/NewTag
     *
     * @var Request $request parameters
     * @return string Rendered response
     */
    public function NewTag(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsPost());
        return $this->actionEntity($params, $this->name, __FUNCTION__);
    }
    
}
