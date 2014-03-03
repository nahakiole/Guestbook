<?php
/**
 * Created by PhpStorm.
 * User: robin.glauser
 * Date: 03.03.14
 * Time: 11:03
 */

namespace Model\Repository;


class Filter {

    private $field;
    private $operator;
    private $value;

    function __construct($field, $operator,$value)
    {
        $this->field = $field;
        $this->operator = $operator;
        $this->value = $value;
    }

    function __toString()
    {
        return "$this->field $this->operator '$this->value'";
    }


}