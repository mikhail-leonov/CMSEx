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
use \Recipe\Abstracts\AbstractController;
use \Recipe\Factories;
use \Recipe\Models;

/**
 * Class Tag Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class TagApiController extends AbstractController
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
        $this->name = "tagapi";
    }

    /**
     * getTags - Returns all Tags 
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function getTags(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->getTags($request->paramsGet());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * postTags - Create a new Tags
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function postTags(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->postTags($request->paramsPost());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * putTags - Bulk update of Tags
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function putTags(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->putTags(Util::paramsPut());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * deleteTags - Delete all Tags
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function deleteTags(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->putTags(Util::paramsDelete());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * getTag - Return a specified Tags
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function getTag(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->getTags($request->paramsGet());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * postTag - Not allowed
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function postTag(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->postTag($request->paramsPost());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * putTag - Update a specified Tags
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function putTag(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->putTag(Util::paramsPut());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
    /**
     * deleteTag - Delete a specified Tags
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function deleteTag(Request $request) : string {
        $TagModel = ModelFactory::build("tag");
        $result = $TagModel->putTag(Util::paramsDelete());

        $decoratorName = Util::GetAttribute($params, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);

        return $result;
    }
}
