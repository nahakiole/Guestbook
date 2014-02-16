<?php

namespace Controller;


class User extends Controller
{
    public $routing
        = [
            'default' => 'Overview',
            'login' => 'userLogin'
        ];

    public function userLogin()
    {

        $this->template = new \View\HTMLView('View/Templates/index.html');
        return $this->template;
    }
} 