<?php


class Autoloader
{

    public function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));;
    }


    public function loadClass($class)
    {
        $class = str_replace("\\", "/", $class);
        require_once($class . ".php");
    }

}