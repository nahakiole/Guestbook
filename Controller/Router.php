<?php


namespace Controller;


use Exception\PageNotFoundException;

class Router
{
    /**
     * @var \Model\Entity\Route[]
     */
    private $routingTable = [];
    private $requestURI = [];
    private $controllerName;
    private $actionName;

    public function __construct($file)
    {
        $file = require $file;
        $this->routingTable = array_merge($file, $this->routingTable);
        $this->requestURI = $_SERVER['REQUEST_URI'];
    }

    /**
     * @throws \Exception\PageNotFoundException
     * @return mixed
     */
    public function getControllerName()
    {
        foreach ($this->routingTable as $route) {
            $controller = $route->matchesRoute($this->requestURI);
            if ($controller){
                $this->actionName = $route->method;
                return $controller;
            }
        }
        throw new PageNotFoundException("Not Page under $this->requestURI found");
    }

    /**
     * @param $controller
     *
     * @throws \Exception\PageNotFoundException
     * @return string
     */
    public function getControllerMethod($controller)
    {
        if (isset($this->actionName)
            && method_exists(
                $controller, $this->actionName
            )
        ) {
            return $this->actionName;
        } else {
            throw new PageNotFoundException("Method " . $this->actionName . " not found!");
        }
    }
}