<?php


namespace View;


class Redirect implements Viewable
{

    private $header;

    public function __construct($header)
    {
        $this->setHeader($header);
    }

    public function setHeader($header)
    {
        $this->header = $header;
    }

    public function render()
    {
        header($this->header);
    }
}