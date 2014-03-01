<?php

namespace Controller;

use DI\ContainerBuilder;
use Exception\ControllerException;

class Guestbook
{
    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions('Config.php');
        $containerBuilder->addDefinitions('Services.php');
        $container = $containerBuilder->build();

        $act = isset($_GET['action']) ? $_GET['action'] : 'default';
        $controllerName = !isset($_GET['controller']) ? 'default' : $_GET['controller'];
        $router = new Router($controllerName, $act);
        try {
            $controllerName = $router->getControllerName();
            $controller = $container->get($controllerName);
            $method = $router->getControllerMethod($controller);
            $view = $controller->$method();
        } catch (ControllerException $e) {
            $controller = $container->get($e->getController());
            $method = $e->getAction();
            $view = $controller->$method();
        }
        echo $view->render();
    }

    private function createInstance($class, $params)
    {
        $reflection_class = new \ReflectionClass($class);
        return $reflection_class->newInstanceArgs($params);
    }
}
