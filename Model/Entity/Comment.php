<?php

namespace Model\Entity;


class Comment extends Entity
{
    /**
     * @param $name    Field
     * @param $place   Field
     * @param $mail    Field
     * @param $url     Field
     * @param $comment Field
     */
    public function __construct($name, $place, $mail, $url, $comment)
    {
        $this->fields[] = $name;
        $this->fields[] = $place;
        $this->fields[] = $mail;
        $this->fields[] = $url;
        $this->fields[] = $comment;
    }
} 