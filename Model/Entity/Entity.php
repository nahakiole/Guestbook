<?php


namespace Model\Entity;


abstract class Entity
{
    /**
     * @var Field[]
     */
    public $fields;

    public function getField($name){
        foreach ($this->fields as $field) {
            if ($field->name == $name) {
                return $field;
            }
        }
        return null;
    }

    public function sanatizeField(){
        foreach ($this->fields as $field) {
            $field->value = html_entity_decode(utf8_decode($field->value));
        }
    }
}