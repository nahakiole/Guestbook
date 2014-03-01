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

    abstract function getInput($name, $value, $options = []);

    abstract function getTextarea($name, $value, $options = []);

    abstract function getSubmit($name, $value, $options = []);
}