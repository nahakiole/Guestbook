<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 25.02.14
 * Time: 19:42
 */

namespace View;


class JavascriptView implements Viewable
{

    public $content = '';

    public function render()
    {
        return $this->content;
    }
}