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
 * Class Group Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class GroupUiController extends AbstractController
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
        $this->name = "groupui";
    }

    /**
     * getGroups - Returns all groups 
     * 
     * @var Request $request parameters
     *
     * @return string Rendered response
     */
    public function getGroups(Request $request) : string {
        $params = $this->MergedRequestParams($request, $request->paramsGet());

        $groupModel = ModelFactory::build("group");
        $groupsObj  = $groupModel->getGroups($params);

        $pageView   = PageViewFactory::build("groups");

        $contentView = PartViewFactory::build("groups");

        $groups = [];
        if ( !empty($groupsObj->data->groups)) {
             $groups = $groupsObj->data->groups;
        }

	$tree = new Tree();
	$tree->AssignGroups($groups);

        $contentView->assign("groups", $groups);
        $contentView->assign("tree", $tree);

        $content = $contentView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }
}
