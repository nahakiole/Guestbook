<?php

namespace Controller;


use View\HTMLView;

class User extends Controller
{

    /**
     * @Inject
     * @var \PDO
     */
    public $db;

    /**
     * @Inject
     *
     * @param \PDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function userLogin()
    {
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => 'Noch nicht Implementiert',
                'SITE_DESC' => 'Lorem Ipsum'
            ]
        );
        var_dump($_POST);
        return $this->template;
    }
} 