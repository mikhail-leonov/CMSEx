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
class GroupApiController extends \Recipe\Abstracts\AbstractController
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
        $this->name = "groupapi";
    }

    /**
     * getGroups - Returns all groups 
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function getGroups(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->getGroups($request->paramsGet());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * postGroups - Create a new groups
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function postGroups(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->postGroups($request->paramsPost());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * putGroups - Bulk update of groups
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function putGroups(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->putGroups(Util::paramsPut());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * deleteGroups - Delete all groups
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function deleteGroups(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->putGroups(Util::paramsDelete());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * getGroup - Return a specified groups
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function getGroup(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->getGroups($request->paramsGet());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * postGroup - Not allowed
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function postGroup(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->postGroup($request->paramsPost());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * putGroup - Update a specified groups
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function putGroup(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->putGroup(Util::paramsPut());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * deleteGroup - Delete a specified groups
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function deleteGroup(Request $request) : string {
        $groupModel = ModelFactory::build("group");
        $result = $groupModel->putGroup(Util::paramsDelete());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
}
