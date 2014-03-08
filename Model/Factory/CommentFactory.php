<?php

namespace Model\Factory;


use Model\Entity\Comment;
use Model\Entity\Field;

class CommentFactory extends Factory
{

    function build($data)
    {
        return new Comment(
            new Field('Name', Field::TYPE_TEXT, null, true, $data['name']),
            new Field('Ort', Field::TYPE_TEXT, null, true, $data['place']),
            new Field('Email', Field::TYPE_EMAIL, FILTER_VALIDATE_EMAIL, true, $data['mail']),
            new Field('URL', Field::TYPE_TEXT, FILTER_VALIDATE_URL, true , $data['url']),
            new Field('Kommentar', Field::TYPE_TEXTAREA, null,true , $data['comment'])
        );
    }
}