<?php


namespace Controller;


use Exception\PageNotFoundException;

class Router
{

    private $routing
        = [
            'default' => '\Controller\Comment',
            'comment' => '\Controller\Comment',
            'user' => '\Controller\User',
            'Error' => '\Controller\Error'
        ];

    private $controllerName;
    private $actionName;

    public function __construct()
    {
        $controllerName = !isset($_GET['controller']) ? 'default' : $_GET['controller'];
        $actionName = isset($_GET['action']) ? $_GET['action'] : 'default';
        $this->controllerName = $controllerName;
        $this->actionName = $actionName;
    }

    /**
     * @throws \Exception\PageNotFoundException
     * @return mixed
     */
    public function getControllerName()
    {
        if (isset($this->routing[$this->controllerName])) {
            return isset($this->routing[$this->controllerName]) ? $this->routing[$this->controllerName]
                : $this->routing['default'];
        } else {
            throw new PageNotFoundException("Method " . $this->actionName . " not found!");
        }
    }

    /**
     * @param $controller
     *
     * @throws \Exception\PageNotFoundException
     * @return string
     */
    public function getControllerMethod($controller)
    {
        if (isset($controller->routing[$this->actionName])
            && method_exists(
                $controller, $controller->routing[$this->actionName]
            )
        ) {
            return $controller->routing[$this->actionName];
        } else {
            throw new PageNotFoundException("Method " . $this->actionName . " not found!");
        }
    }
}