<?php


namespace Exception;


abstract class ControllerException extends \Exception {
    protected $controller = '\Controller\Error';
    protected $action;

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
}