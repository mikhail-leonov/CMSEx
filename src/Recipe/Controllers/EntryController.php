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
 * Class Entry Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class EntryController extends \Recipe\AbstractController
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
     * PAGE: api/index
     * This method handles what happens when you move to http://yourproject/entry/index
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function index(array $params)
    {
        header('Location: /');
    }

    /**
     * PAGE: entry/view
     * This method handles what happens when you move to http://yourproject/entry/view/ID
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function view(array $params)
    {
        $href = Util::GetAttribute($_SERVER, 'HTTP_REFERER', '/');

        $entry_id = Util::GetAttribute($params, 'entry_id', "0");
        
        $entryModel = ModelFactory::build("entry");
        $entry      = $entryModel->GetEntryData($entry_id);

        $tagModel   = ModelFactory::build("tag");
        $groups     = $tagModel->getGroups();
        $entry_tags = $tagModel->getEntryTags($entry_id);
        $tags       = $tagModel->getTags();
        $selected   = $tagModel->getSelectedTags();

        $pageView   = ViewFactory::build("page.page");

        $leftmenuView = ViewFactory::build("left_menu_ex.part");
        $leftmenuView->assign("entry", $entry);
        $leftmenuView->assign("selected", $selected);
        $leftmenuView->assign("tags", $tags);
        $leftmenuView->assign("groups", $groups);
        $left_menu = $leftmenuView->fetch();
            
        $pageView->assign("left_menu", $left_menu);

        $entryviewView = ViewFactory::build("entry_view.part");
        $entryviewView->assign("groups", $groups);
        $entryviewView->assign("entry_tags", $entry_tags);
        $entryviewView->assign("entry", $entry);
        $entryviewView->assign("href", $href);
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);

        $pageView->display();
    }

    /**
     * PAGE: entry/print
     * This method handles what happens when you move to http://yourproject/entry/print/ID
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function print(array $params)
    {
        $href = Util::GetAttribute($_SERVER, 'HTTP_REFERER', '/');

        $entry_id = Util::GetAttribute($params, 'entry_id', "0");

        $entryModel = ModelFactory::build("entry");
        $entry      = $entryModel->GetEntryData($entry_id);

        $tagModel = ModelFactory::build("tag");
        $entry_tags = $tagModel->getEntryTags($entry_id);

        $pageView     = ViewFactory::build("print.page");

        $entryviewView = ViewFactory::build("entry_print.part");
        $entryviewView->assign("entry_tags", $entry_tags);
        $entryviewView->assign("entry", $entry);
        $entryviewView->assign("href", $href);
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);
        
        $pageView->display();
    }

    /**
     * PAGE: entry/edit
     * This method handles what happens when you move to http://yourproject/entry/edit/ID
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function edit(array $params)
    {
        $href = Util::GetAttribute($_SERVER, 'HTTP_REFERER', '/');

        $entry_id = Util::GetAttribute($params, 'entry_id', "0");

        $entryModel = ModelFactory::build("entry");
        $entry = $entryModel->GetEntryData($entry_id);

        $tagModel   = ModelFactory::build("tag");
        $groups     = $tagModel->getGroups();
        $entry_tags = $tagModel->getEntryTags($entry_id);
        $tags       = $tagModel->getTags();
        $selected   = $tagModel->getSelectedTags();

        $pageView     = ViewFactory::build("edit.page");

        $leftmenuView = ViewFactory::build("left_menu_ex.part");
        $leftmenuView->assign("entry", $entry);
        $leftmenuView->assign("selected", $selected);
        $leftmenuView->assign("tags", $tags);
        $leftmenuView->assign("groups", $groups);
        $left_menu = $leftmenuView->fetch();

        $pageView->assign("left_menu", $left_menu);

        $entryviewView = ViewFactory::build("entry_edit.part");
        $entryviewView->assign("groups", $groups);
        $entryviewView->assign("entry_tags", $entry_tags);
        $entryviewView->assign("entry", $entry);
        $entryviewView->assign("href", $href);
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);

        $pageView->display();
    }

    /**
     * PAGE: entry/new
     * This method handles what happens when you move to http://yourproject/entry/new
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function new(array $params)
    {
        $href = Util::GetAttribute($_SERVER, 'HTTP_REFERER', '/');

        $tagModel   = ModelFactory::build("tag");
        $groups     = $tagModel->getGroups();
        $tags       = $tagModel->getTags();
        $selected   = $tagModel->getSelectedTags();

        $pageView     = ViewFactory::build("edit.page");

        $leftmenuView = ViewFactory::build("left_menu.part");
        $leftmenuView->assign("selected", $selected);
        $leftmenuView->assign("tags", $tags);
        $leftmenuView->assign("groups", $groups);
        $left_menu = $leftmenuView->fetch();

        $pageView->assign("left_menu", $left_menu);

        $entryviewView = ViewFactory::build("entry_new.part");
        $entryviewView->assign("href", $href);
        $content = $entryviewView->fetch();

        $pageView->assign("content", $content);

        $pageView->display();
    }
}
