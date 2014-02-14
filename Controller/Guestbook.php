<?php

namespace Controller;
require_once 'Controller/Controller.php';
require_once 'Controller/Comment.php';
require_once 'Controller/NotFound.php';
require_once 'View/HTMLView.php';
require_once 'View/HTMLTemplate.php';
require_once 'View/JSONView.php';

class Guestbook
{
    private $routing = [
        'default' => '\Controller\Comment',
        'comment' => '\Controller\Comment',
        '404' => '\Controller\NotFound'
    ];

    public function __construct()
    {
        $mysqli = new \mysqli('localhost', 'root', 'toor', 'guestbook');
        $act = isset($_GET['action']) ? $_GET['action'] : 'default';
        $controllerName = !isset($_GET['controller']) ?  'default' : $_GET['controller'];
        try {
            if (isset($this->routing[$controllerName])) {
                $controllerName = isset($this->routing[$controllerName]) ? $this->routing[$controllerName] : $this->routing['default'];
                $controller = $this->createInstance($controllerName, [$mysqli,$act]);

                if (method_exists ( $controller , $controller->routing[$act] )){
                    $view = call_user_func(array($controller, $controller->routing[$act]));
                }
                else {
                    throw new PageNotFoundException("Method ".$act."not found!");
                }
                echo $view->render();
            }
            else {
                throw new PageNotFoundException("Controller ".$controllerName." not found!");
            }
        } catch (PageNotFoundException $e) {
            echo $e->getFile().":".$e->getLine()." ".$e->getMessage();
        }

    }

    private function createInstance($class, $params)
    {
        $reflection_class = new \ReflectionClass($class);
        return $reflection_class->newInstanceArgs($params);
    }
}

class PageNotFoundException extends \Exception {

}
