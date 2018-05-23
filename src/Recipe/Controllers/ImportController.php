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

use \Recipe\Factories\ModelFactory;

/**
 * Class Import Controller
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class ImportController extends \Recipe\Abstracts\AbstractController
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
     * @return void
     */
    public function index(array $params)
    {
        $pageView    = ViewFactory::build("import.page");
        $importView  = ViewFactory::build("import.part");

        $importModel = ModelFactory::build("import");

        $rules = $importModel->getRules();
        $importView->assign("rules", $rules);

        $pageView->assign("content", $importView->fetch());
        $pageView->display();
    }

    /**
     * PAGE: import load settings
     * This method handles what happens when you move to http://yourproject/import/load/settings
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function load(array $params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->load($_POST);

        $decoratorName = Util::GetAttribute($_POST, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);
    
        print($result);
    }

    /**
     * PAGE: import save settings
     * This method handles what happens when you move to http://yourproject/import/save/settings
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function save(array $params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->save($_POST);

        $decoratorName = Util::GetAttribute($_POST, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);
        
        print($result);
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
        $importModel = ModelFactory::build("import");
        $result = $importModel->start($_POST);
        
        $decoratorName = Util::GetAttribute($_POST, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);
        
        print($result);
    }

    /**
     * PAGE: test DB connection
     * This method handles what happens when you move to http://yourproject/import/test/connection
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function test(array $params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->test();
        
        $decoratorName = Util::GetAttribute($_POST, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);
        
        print($result);
    }

    /**
     * PAGE: Get DB table settings
     * This method handles what happens when you move to http://yourproject/import/table
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function table(array $params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->table();
        
        $decoratorName = Util::GetAttribute($_POST, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);
        
        print($result);
    }
    /**
     * PAGE: Get DB table list
     * This method handles what happens when you move to http://yourproject/import/tablelist
     *
     * @var array $params parameters
     *
     * @return void
     */
    public function tablelist(array $params)
    {
        $importModel = ModelFactory::build("import");
        $result = $importModel->tablelist();
        
        $decoratorName = Util::GetAttribute($_POST, 'format', 'json');
        $decorator = DecoratorFactory::build($decoratorName);
        $result = $decorator->Decorate($result);
        
        print($result);
    }
}
