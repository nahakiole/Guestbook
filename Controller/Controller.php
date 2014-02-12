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
    public  $routing;
    /**
     * @var \View\Viewable
     */
    protected $template;

    public function __construct($db,$act)
    {
        $this->db = $db;
    }
} 