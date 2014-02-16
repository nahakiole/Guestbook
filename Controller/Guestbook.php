<?php

namespace Controller;

class Guestbook
{
    private $routing
        = [
            'default' => '\Controller\Comment',
            'comment' => '\Controller\Comment',
            'user' => '\Controller\User',
            'Error' => '\Controller\Error'
        ];

    /**
     * @param $config \Config
     */
    public function __construct()
    {
        $mysqli = new \mysqli('localhost', 'root', 'toor', 'guestbook');
        $act = isset($_GET['action']) ? $_GET['action'] : 'default';
        $controllerName = !isset($_GET['controller']) ? 'default' : $_GET['controller'];
        try {
            if (isset($this->routing[$controllerName])) {
                $controllerName = isset($this->routing[$controllerName]) ? $this->routing[$controllerName]
                    : $this->routing['default'];
                $controller = $this->createInstance($controllerName, [$mysqli]);

                if (isset($controller->routing[$act]) && method_exists($controller, $controller->routing[$act])) {
                    $view = call_user_func(array($controller, $controller->routing[$act]));
                } else {
                    throw new PageNotFoundException("Method " . $act . "not found!");
                }

            } else {
                throw new PageNotFoundException("Controller " . $controllerName . " not found!");
            }
        } catch (PageNotFoundException $e) {
            $controller = new Error($mysqli);
            $view = $controller->notFound();
        }
        echo $view->render();
    }

    private function createInstance($class, $params)
    {
        $reflection_class = new \ReflectionClass($class);
        return $reflection_class->newInstanceArgs($params);
    }
}

class PageNotFoundException extends \Exception
{

}
