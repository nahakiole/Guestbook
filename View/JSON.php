<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 14.02.14
 * Time: 21:10
 */

namespace View;


class JSON implements Viewable
{

    public $jsonData = [];

    public function render()
    {
        header('Content-Type: application/json');
        return json_encode($this->jsonData);
    }
}