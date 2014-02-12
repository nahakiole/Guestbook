<?php

namespace Controller;
require_once 'Controller/Controller.php';
require_once 'Controller/Comment.php';

class Guestbook
{

    private $routing = [
        'default' => '\Controller\Comment'
    ];

    public function __construct()
    {

        $mysqli = new \mysqli('localhost', 'root', 'notchy', 'guestbook');
        $act = isset($_GET['action']) ? $_GET['action'] : 'default';
        $controllerName = !isset($_GET['controller']) ?  'default' : $_GET['controller'];
        try {

            if ($this->routing[$controllerName] != null) {
                $controllerName = $this->routing[$controllerName];
                $controller = $this->createInstance($controllerName, [$mysqli,$act]);
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    private function  createInstance($class, $params)
    {

        $reflection_class = new \ReflectionClass($class);
        return $reflection_class->newInstanceArgs($params);
    }
}
