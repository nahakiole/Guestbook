<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 11.02.14
 * Time: 11:17
 */

namespace Model;


class Comment
{
    public $id;
    public $name;
    public $place;
    public $mail;
    public $url;
    public $comment;

    public function __construct($id, $name, $place, $mail, $url, $comment)
    {
        $this->id = $id;
        $this->name = $name;
        $this->place = $place;
        $this->mail = $mail;
        $this->url = $url;
        $this->comment = $comment;
    }
} 