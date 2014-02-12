<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 11.02.14
 * Time: 11:21
 */

namespace Controller;


class Comment extends Controller {
    protected $routing = [
        'default' => 'Overview'
    ];

    public function Overview()
    {

        echo file_get_contents('View/index.html');
    }

} 