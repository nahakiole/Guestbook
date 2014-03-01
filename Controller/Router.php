<?php


namespace Controller;


use Exceptions\PageNotFoundException;

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

    public function __construct($controllerName, $actionName)
    {
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
            throw new \Exception\PageNotFoundException("Method " . $this->actionName . " not found!");
        }
    }

    /**
     * @param $controller
     *
     * @return string
     * @throws PageNotFoundException
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