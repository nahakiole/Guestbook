<?php


class Autoloader
{

    public function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));;
    }


    public function loadClass($class)
    {
        require_once(str_replace("\\", "/", $class) . ".php");
    }

}