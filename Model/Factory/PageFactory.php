<?php


namespace Model\Factory;


use Model\Entity\Page;
use Model\Entity\Field;

class PageFactory extends Factory {

    function build($data)
    {
        return new Page(
            new Field('Name', Field::TYPE_TEXT, null, true, $data['name']),
            new Field('Title', Field::TYPE_TEXT, null, true, $data['title']),
            new Field('Content', Field::TYPE_TEXTAREA, null,true , $data['content'])
        );
    }
}