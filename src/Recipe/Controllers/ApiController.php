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
use \Recipe\Util;
use \Recipe\Factories\ModelFactory;

/**
 * Class Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ApiController extends \Recipe\Abstracts\AbstractController
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
		$params = $this->paramsPut();
		
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->SelectTag($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
		$params = $request->paramsGet();

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->UnselectTag($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->AddTag($_GET);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->DelTag($_GET);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->NewTag($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->FindTags($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->AssignTags($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->SaveEntry($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
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
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->SaveNewEntry($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
}
