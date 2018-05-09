<?php

class Application
{
    /** @var null The controller */
    private $url_controller = null;

    /** @var null The method (of the above controller), often also named "action" */
    private $url_action = null;

    /** @var null Parameters */
    private $url_parameters = array();

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     */
    public function __construct()
    {
        // create array with URL parts in $url
        $this->splitUrl();

	$controllerFileName = CONTROLLER . $this->url_controller . '.controller.php';

        // check for controller: does such a controller exist ?
        if (file_exists($controllerFileName)) {

            // if so, then load this file and create this controller
            // example: if controller would be "car", then this line would translate into: $this->car = new car();
            require($controllerFileName);
	    $controllerClassName = ucfirst( $this->url_controller ) . "Controller" ;

            $this->url_controller = new $controllerClassName();

            // check for method: does such a method exist in the controller ?
            if (method_exists($this->url_controller, $this->url_action)) {
                    // just call the method wit parameters array
                    $this->url_controller->{$this->url_action}($this->url_parameters);
            } else {
                // default/fallback: call the index() method of a selected controller
                $this->url_controller->index( array() );
            }
        } else {
            // invalid URL, so simply show home/index
	    $controllerFileName = CONTROLLER . 'home.controller.php';	
            require($controllerFileName);
            $home = new HomeController();
            $home->index( array() );
        }
    }

    /**
     * Get and split the URL into controller, action and parameters 
     */
    private function splitUrl()
    {
        if (isset($_GET['url'])) {

            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $parts = explode('/', $url);

            $this->url_controller = (isset($parts[0]) ? strtolower($parts[0]) : null);
            $this->url_action = (isset($parts[1]) ? $parts[1] : null);

	    foreach( $parts as $k => $part ) {
	        if ($k > 1) { $this->url_parameters[] = $part; }
	    }
        }
    }
}
