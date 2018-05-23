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

/**
 * Class Api Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ApiController extends \Recipe\AbstractController
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
     * PAGE: api/index
     * This method handles what happens when you move to http://yourproject/api/index
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function index(array $params)
    {
        $href = Util::GetAttribute($_GET, 'href', '/');
        header("Location: {$href}");
    }

    /**
     * PAGE: api/SelectTag
     * This method handles what happens when you move to http://yourproject/api/SelectTag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function SelectTag(array $params)
    {
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->SelectTag();

        $href = Util::GetAttribute($_GET, 'href', '/');
        header("Location: {$href}");
    }

    /**
     * PAGE: api/UnselectTag
     * This method handles what happens when you move to http://yourproject/api/UnselectTag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function UnselectTag(array $params)
    {
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->UnselectTag();

        $href = Util::GetAttribute($_GET, 'href', '/');
        header("Location: {$href}");
    }

    /**
     * PAGE: api/AddTag
     * This method handles what happens when you move to http://yourproject/api/AddTag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function AddTag(array $params)
    {
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->AddTag($_GET);

        $href = Util::GetAttribute($_GET, 'href', '/');
        header("Location: {$href}");
    }

    /**
     * PAGE: api/DelTag
     * This method handles what happens when you move to http://yourproject/api/DelTag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function DelTag(array $params)
    {
        $apiModel = ModelFactory::build("api");
        $result = $apiModel->DelTag($_GET);

        $href = Util::GetAttribute($_GET, 'href', '/');
        header("Location: {$href}");
    }

    /**
     * PAGE: api/NewTag
     * This method handles what happens when you move to http://yourproject/api/NewTag
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function NewTag(array $params)
    {
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->NewTag($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        print($result);
    }

    /**
     * PAGE: api/FindTags
     * This method handles what happens when you move to http://yourproject/api/FindTags
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function FindTags(array $params)
    {
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->FindTags($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        print($result);
    }

    /**
     * PAGE: api/AssignTags
     * This method handles what happens when you move to http://yourproject/api/AssignTags
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function AssignTags(array $params)
    {
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->AssignTags($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);


        print($result);
    }
    
    /**
     * PAGE: api/SaveEntry
     * This method handles what happens when you move to http://yourproject/api/SaveEntry
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function SaveEntry(array $params)
    {
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->SaveEntry($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        print($result);
    }
    
    /**
     * PAGE: api/SaveNewEntry
     * This method handles what happens when you move to http://yourproject/api/SaveNewEntry
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function SaveNewEntry(array $params)
    {
        $params = array_merge($_POST, $_GET);

        $apiModel = ModelFactory::build("api");
        $result = $apiModel->SaveNewEntry($params);

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        print($result);
    }
}