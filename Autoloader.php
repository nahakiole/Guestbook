<?php


class Autoloader
{

    public function __construct()
    {
        spl_autoload_register(array($this, 'loadClass'));;
    }


    public function loadClass($class)
    {
        $file = str_replace("\\", "/", $class) . ".php";
        if (file_exists($file)){
            require_once($file);
        }
    }

}