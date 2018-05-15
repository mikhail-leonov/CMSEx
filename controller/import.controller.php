<?php
/**
 * Include section
 */
require_once(CONTROLLER . 'abstract.controller.php');
require_once(FACTORY . 'model.factory.php');
require_once(FACTORY . 'view.factory.php');
require_once(LIB . 'xml.class.php');

/**
 * Class Import Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ImportController extends AbstractController
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
        $this->name = "import";
    }

    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/import/index (which is the default page btw)
     * 
     * @var array $params parameters 
     * 
     * @return string 
     */
    public function index($params)
    {
        $pageView    = ViewFactory::build("import.page");
        $importView  = ViewFactory::build("import.part");

        $importModel = ModelFactory::build("import");
        $importView->assign("rules", $importModel->getRules());

        $pageView->assign("content", $importView->fetch());

        // Display Page
        $pageView->display();
    }

    /**
     * PAGE: import load settings
     * This method handles what happens when you move to http://yourproject/import/load/settings
     * 
     * @var array $params parameters 
     * 
     * @return string json encoded rule array
     */
    public function load($params)
    {
        $rule = [];
        $rule_file_name = Util::GetAttribute($_POST, 'rule_file_name', '');
        $rule_file_name = RULES . $rule_file_name;
        if (file_exists($rule_file_name)) {
            $importModel = ModelFactory::build("import");
            $rule = $importModel->load($rule_file_name);
        }
        print(json_encode($rule));
    }

    /**
     * PAGE: import save settings
     * This method handles what happens when you move to http://yourproject/import/save/settings
     * 
     * @var array $params parameters 
     * 
     * @return int 0|1 
     */
    public function save($params)
    {
        $result = 0;
        $settings = Util::GetAttribute($_POST, 'settings', []);
        $title = Util::GetAttribute($settings, 'ruleTitle', '');
        $title = trim($title);
        if ('' !== $title) {
            $slug = str_replace(' ', '_', strtolower($title));
            $rule_file_name = RULES . $slug . ".rule.xml";

            $importModel = ModelFactory::build("import");
            $importModel->save($rule_file_name);
            $result = 1;
        }
        return $result;
    }

    /**
     * PAGE: start import
     * This method handles what happens when you move to http://yourproject/import/start
     * 
     * @var array $params parameters 
     * 
     * @return int 0|1 
     */
    public function start($params)
    {
        $result = 0;
        $settings = Util::GetAttribute($_POST, 'settings', []);
        $title = Util::GetAttribute($settings, 'ruleTitle', '');
        $title = trim($title);
        if ('' !== $title) {
            $slug = str_replace(' ', '_', strtolower($title));
            $rule_file_name = RULES . $slug . ".rule.xml";

            $importModel = ModelFactory::build("import");
            $importModel->start($rule_file_name);
            $result = 1;
        }
        return $result;
    }

    /**
     * PAGE: test DB connection
     * This method handles what happens when you move to http://yourproject/import/test/connection
     * 
     * @var array $params parameters 
     * 
     * @return string 
     */
    public function test($params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->test();
        print($result);
    }

    /**
     * PAGE: Get DB table settings
     * This method handles what happens when you move to http://yourproject/import/table
     * 
     * @var array $params parameters 
     * 
     * @return string json encoded table fields array
     */
    public function table($params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->table();

        print(json_encode($result));
    }
    /**
     * PAGE: Get DB table list
     * This method handles what happens when you move to http://yourproject/import/tablelist
     * 
     * @var array $params parameters 
     * 
     * @return string json encoded table array
     */
    public function tablelist($params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->tablelist();

        print(json_encode($result));
    }
}
