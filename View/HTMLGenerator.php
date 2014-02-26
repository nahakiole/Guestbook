<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 25.02.14
 * Time: 11:03
 */

namespace View;


abstract class HTMLGenerator
{
    public $name;

    abstract function getInput($name, $value);

    abstract function getTextarea($name, $value);

    abstract function getSubmit($name, $value);
}