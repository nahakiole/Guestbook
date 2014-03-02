<?php


namespace Model\Entity;


class Route {
    private $route;
    private $controller;
    public  $method;

    public function __construct($route, $controller,$method){
        $this->route = $route;
        $this->controller = $controller;
        $this->method = $method;
    }

    public function matchesRoute($localRoute){
        if (preg_match($this->route, $localRoute)){
            return $this->controller;
        }
        return null;
    }
}