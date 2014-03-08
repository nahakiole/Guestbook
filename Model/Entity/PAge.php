<?php


namespace Model\Entity;


class Page extends Entity {

    /**
     * @internal param \Model\Entity\Field $name
     * @internal param \Model\Entity\Field $title
     * @internal param \Model\Entity\Field $content
     */
    public function __construct($name, $title, $content)
    {
        $this->fields[] = $name;
        $this->fields[] = $title;
        $this->fields[] = $content;
    }

} 