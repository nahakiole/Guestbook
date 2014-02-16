<?php

namespace Controller;

class Controller
{
    /**
     * @var \mysqli
     */
    protected $db;
    public $routing;
    /**
     * @var \View\Viewable
     */
    protected $template;

    public function __construct($db)
    {
        $this->db = $db;
    }
} 