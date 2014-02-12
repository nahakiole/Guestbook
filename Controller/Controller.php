<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 10.02.14
 * Time: 15:10
 */
namespace Controller;

class Controller {
    /**
     * @var \mysqli
     */
    protected $db;
    protected $routing;
    /**
     * @var \View\Viewable
     */
    protected $template;

    public function __construct($db,$act)
    {
        $this->db = $db;
        call_user_func(array($this, $this->routing[$act]));
    }
} 