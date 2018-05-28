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
use \Recipe\Abstracts\AbstractController;
use \Recipe\Factories\PageViewFactory;
use \Recipe\Factories\PartViewFactory;
use \Recipe\Factories\ModelFactory;
use \Recipe\Models;
use \Recipe\Views;

/**
 * Class Entry Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryController extends AbstractController
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
     * GetSelectedEntries
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function GetSelectedEntries(Request $request) : string
    {
        $params     = $request->paramsGet();
        $pageView   = PageViewFactory::build("entries");

        $tagModel   = ModelFactory::build("tag");
        $tags       = $tagModel->getTags(new DataCollection());
        $tags       = $tags->data->tags;

        $selected   = $tagModel->getSelectedTags();
        $selected   = $selected->data->tags;

        $groupModel = ModelFactory::build("group");
        $groups     = $groupModel->getGroups(new DataCollection());
        $groups     = $groups->data->groups;

        $entryModel = ModelFactory::build("entry");
        $entries = $entryModel->GetSelectedEntries($params);

        $pageView->assign("selected", $selected);
        $pageView->assign("tags", $tags);
        $pageView->assign("groups", $groups);
        
        $recipiesView   = PartViewFactory::build("entries");
        $recipiesView->assign("entries", $entries);
        $content = $recipiesView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }

    /**
     * GetFoundEntries
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function GetFoundEntries(Request $request) : string
    {
        $params     = $request->paramsGet();
        $pageView   = PageViewFactory::build("entries");

        $tagModel   = ModelFactory::build("tag");
        $tags       = $tagModel->getTags(new DataCollection());
        $tags       = $tags->data->tags;

        $selected   = $tagModel->getSelectedTags();
        $selected   = $selected->data->tags;

        $groupModel = ModelFactory::build("group");
        $groups     = $groupModel->getGroups(new DataCollection());
        $groups     = $groups->data->groups;

        $entryModel = ModelFactory::build("entry");
        $entries = $entryModel->GetFoundEntries($params);

        $pageView->assign("selected", $selected);
        $pageView->assign("tags", $tags);
        $pageView->assign("groups", $groups);
        
        $recipiesView   = PartViewFactory::build("entries");
        $recipiesView->assign("entries", $entries);
        $content = $recipiesView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }

    /**
     * GetAllEntries
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function GetAllEntries(Request $request) :string
    {
        $params     = $request->paramsGet();
        $pageView   = PageViewFactory::build("entries");

        $tagModel   = ModelFactory::build("tag");
        $tags       = $tagModel->getTags(new DataCollection());
        $tags       = $tags->data->tags;

        $selected   = $tagModel->getSelectedTags();
        $selected   = $selected->data->tags;

        $groupModel = ModelFactory::build("group");
        $groups     = $groupModel->getGroups(new DataCollection());
        $groups     = $groups->data->groups;

        $entryModel = ModelFactory::build("entry");
        $entries = $entryModel->GetAllEntries($params);

        $pageView->assign("selected", $selected);
        $pageView->assign("tags", $tags);
        $pageView->assign("groups", $groups);
        
        $recipiesView   = PartViewFactory::build("entries");
        $recipiesView->assign("entries", $entries);
        $content = $recipiesView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }

    /**
     * ViewEntry
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function ViewEntry(Request $request) : string
    {
        $params     = $request->paramsGet();
        $entry_id   = $request->entry_id;
        
        $entryModel = ModelFactory::build("entry");
        $entry      = $entryModel->GetEntryById($entry_id);

        $tagModel   = ModelFactory::build("tag");
        $entry_tags = $tagModel->getEntryTags($entry_id);
        $entry_tags = $entry_tags->data->tags;

        $tags       = $tagModel->getTags(new DataCollection());
        $tags       = $tags->data->tags;

        $selected   = $tagModel->getSelectedTags();
        $selected   = $selected->data->tags;

        $groupModel = ModelFactory::build("group");
        $groups     = $groupModel->getGroups(new DataCollection());
        $groups     = $groups->data->groups;

        $pageView   = PageViewFactory::build("entry.view");

        $pageView->assign("entry", $entry);
        $pageView->assign("selected", $selected);
        $pageView->assign("tags", $tags);
        $pageView->assign("groups", $groups);

        $entryviewView = PartViewFactory::build("entry_view");
        $entryviewView->assign("groups", $groups);
        $entryviewView->assign("entry_tags", $entry_tags);
        $entryviewView->assign("entry", $entry);
        $entryviewView->assign("href", '');
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }

    /**
     * EditEntry
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function EditEntry(Request $request) : string
    {
        $params     = $request->paramsGet();
        $entry_id   = $request->entry_id;
        
        $entryModel = ModelFactory::build("entry");
        $entry      = $entryModel->GetEntryById($entry_id);

        $tagModel   = ModelFactory::build("tag");
        $entry_tags = $tagModel->getEntryTags($entry_id);
        $entry_tags = $entry_tags->data->tags;

        $tags       = $tagModel->getTags(new DataCollection());
        $tags       = $tags->data->tags;

        $selected   = $tagModel->getSelectedTags();
        $selected   = $selected->data->tags;

        $groupModel = ModelFactory::build("group");
        $groups     = $groupModel->getGroups(new DataCollection());
        $groups     = $groups->data->groups;

        $pageView   = PageViewFactory::build("entry.view");

        $pageView->assign("entry", $entry);
        $pageView->assign("selected", $selected);
        $pageView->assign("tags", $tags);
        $pageView->assign("groups", $groups);

        $entryviewView = PartViewFactory::build("entry_edit");
        $entryviewView->assign("groups", $groups);
        $entryviewView->assign("entry_tags", $entry_tags);
        $entryviewView->assign("entry", $entry);
        $entryviewView->assign("href", '');
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }

    /**
     * PrintEntry
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function PrintEntry(Request $request) : string
    {
        $params     = $request->paramsGet();
        $entry_id   = $request->entry_id;

        $entryModel = ModelFactory::build("entry");
        $entry      = $entryModel->GetEntryById($entry_id);

        $tagModel = ModelFactory::build("tag");
        $entry_tags = $tagModel->getEntryTags($entry_id);
        $entry_tags = $entry_tags->data->tags;

        $pageView     = PageViewFactory::build("entry.print");

        $entryviewView = PartViewFactory::build("entry_print");
        $entryviewView->assign("entry_tags", $entry_tags);
        $entryviewView->assign("entry", $entry);
        $entryviewView->assign("href", '');
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);
        
        return $pageView->fetch();
    }

    /**
     * NewEntry
     *
     * @var Request $request parameters
     *
     * @return string Rendered page
     */
    public function NewEntry(Request $request) : string
    {
        $params     = $request->paramsGet();
        $entry_id   = $request->entry_id;

        $tagModel   = ModelFactory::build("tag");

        $tags       = $tagModel->getTags(new DataCollection());
        $tags       = $tags->data->tags;

        $selected   = $tagModel->getSelectedTags();
        $selected   = $selected->data->tags;

        $groupModel = ModelFactory::build("group");
        $groups     = $groupModel->getGroups(new DataCollection());
        $groups     = $groups->data->groups;

        $pageView   = PageViewFactory::build("entry.new");

        $pageView->assign("selected", $selected);
        $pageView->assign("tags", $tags);
        $pageView->assign("groups", $groups);

        $entryviewView = PartViewFactory::build("entry_new");
        $entryviewView->assign("href", '');
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);

        return $pageView->fetch();
    }
}
