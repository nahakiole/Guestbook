<?php

namespace Controller;

use DI\ContainerBuilder;
use Exception\ControllerException;

class Guestbook
{
    private $container;

    public function __construct()
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions('Config.php');
        $containerBuilder->addDefinitions('Services.php');
        $this->container = $containerBuilder->build();
        $router = new Router();
        try {
            $controller = $this->container->get($router->getControllerName());
            $method = $router->getControllerMethod($controller);
            $view = $this->getView($controller, $method);
        } catch (ControllerException $e) {
            $view = $this->getView($this->container->get($e->getController()), $e->getAction());
        }
        echo $view->render();
    }

    /**
     * @param $controller
     * @param $method
     *
     * @return \View\Viewable
     */
    private function getView($controller, $method)
    {
        return $controller->$method();
    }
}
