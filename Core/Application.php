<?php

namespace Core;

/**
 * Application Class
 * @package Mamadou\Core
 */
class Application
{
    protected $controller;
    protected $action;
    protected $params;

    /**
     * Application Class Constructor
     */
    public function __construct()
    {
        session_start();

        $this->prepareURL($_SERVER['REQUEST_URI']);
        $this->serve();
    }

    /**
     * Parsing the URL
     *
     * @param string $uri
     * @return void
     */
    private function prepareURL(string $uri)
    {
        $request = trim($uri, '/');
        if (!empty($uri)) {
            $uriPattern       = explode('/', $request);
            $this->controller =
            isset($uriPattern[0]) && !empty($uriPattern[0]) ?
            ucfirst($uriPattern[0]) . 'Controller' : config('application.default_controller');
            $this->action =
            isset($uriPattern[0]) && !empty($uriPattern[1]) ? $uriPattern[1] : config('application.default_action');
            unset($uriPattern[0], $uriPattern[1]);
            $this->params = !empty($uriPattern) ? array_values($uriPattern) : [];
        }
    }

    /**
     * Serving the application
     *
     * @return void
     */
    public function serve()
    {
        // dump(CONTROLLERS_DIR . DS . $this->controller . '.php');
        if (file_exists(CONTROLLERS_DIR . DS . $this->controller . '.php')) {
            $this->controller = 'App\\Controllers\\' . $this->controller;
            $this->controller = new $this->controller;
            if (method_exists($this->controller, $this->action)) {
                call_user_func_array([$this->controller, $this->action], $this->params);
            } else {
                $this->display404Page();
            }
        } else {
            $this->display404Page();
        }
    }

    /**
     * Displaying 404 error page
     *
     * @return void
     */
    public function display404Page()
    {
        require VIEWS_DIR . DS . '404' . '.' . config('application.views_file_extension');
        header("HTTP/1.0 404 Not Found");
        exit();
    }
}
