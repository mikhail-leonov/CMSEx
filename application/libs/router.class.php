<?php
/**
 * Router Class
 */
class Router
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null controller "action" */
    private $url_action = null;

    /** @var array Action Parameters */
    private $url_parameters = [];

    /** @var null Language */
    private $language = null;

    /**
     * Constructor for router
     *
     * @return void
     */
    public function __construct($language)
    {
        $this->language = $language;
    }

    /**
     * Actual routing
     *
     * @return void
     */
    public function route()
    {
        $this->splitUrl();

        $controllerFileName = CONTROLLER . $this->url_controller . '.controller.php';

        if (file_exists($controllerFileName)) {
            require($controllerFileName);
            $controllerClassName = ucfirst($this->url_controller) . "Controller" ;

            $this->url_controller = new $controllerClassName();

            if (method_exists($this->url_controller, $this->url_action)) {
                $this->url_controller->{$this->url_action}($this->url_parameters);
            } else {
                $this->url_controller->index([]);
            }
        } else {
            $controllerFileName = CONTROLLER . 'home.controller.php';
            require($controllerFileName);
            $home = new HomeController();
            $home->index([]);
        }
    }
    

    /**
     * Get and split the URL into controller, action and parameters
     *
     * @return void
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $parts = explode('/', $url);

            $this->url_controller = (isset($parts[0]) ? strtolower($parts[0]) : null);
            $this->url_action = (isset($parts[1]) ? $parts[1] : null);

            foreach ($parts as $k => $part) {
                if ($k > 1) {
                    $this->url_parameters[] = $part;
                }
            }
        }
    }
}
