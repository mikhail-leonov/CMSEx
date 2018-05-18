<?php
/**
 * Include section
 */
require_once(LIB . 'language.class.php');
require_once(LIB . 'router.class.php');

/**
 * Application Class
 */
class Application
{

    /** @var null Parameters */
    private $language = null;

    /** @var null Parameters */
    private $router = null;

    /**
     * "Start" the application:
     * Analyze the URL elements and calls the according controller/method or the fallback
     *
     * @return void
     */
    public function __construct()
    {
        $this->language = new Language("en-US");
        $this->router = new Router($this->language);
        $this->router->route();
    }
}
