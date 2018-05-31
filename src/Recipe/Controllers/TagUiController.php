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
use \Recipe\Factories\ModelFactory;
use \Recipe\Factories\PageViewFactory;
use \Recipe\Factories\PartViewFactory;
use \Recipe\Abstracts\AbstractController;
use \Recipe\Models;
use \Recipe\Utils\Util;
use \Recipe\Trees\Tree;

/**
 * Class Tag Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class TagUiController extends AbstractController
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
        $this->name = "tagui";
    }

    /**
     * getTags - Returns all Tags 
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function getTags(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());
    
        $groupModel = ModelFactory::build("group");
        $groupsObj  = $groupModel->getGroups($params);
        $groups = [];
        if ( !empty($groupsObj->data->groups)) {
             $groups = $groupsObj->data->groups;
        }

        $tagModel = ModelFactory::build("tag");
        $tagsObj  = $tagModel->getTags($params);

        $pageView   = PageViewFactory::build("tags");

        $contentView = PartViewFactory::build("tags");
        $tags = [];
        if ( !empty($tagsObj->data->tags)) {
             $tags = $tagsObj->data->tags;
        }
        $tagModel   = ModelFactory::build("tag");
        $tags       = $tagModel->getTags($params);
        $tags       = $tags->data->tags;

	$tree = new Tree();
	$tree->AssignGroups($groups);
	$tree->AssignTags($tags);

        $contentView->assign("tags", $tags);
        $contentView->assign("tree", $tree);

        $content = $contentView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }
}
