<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 11.02.14
 * Time: 11:21
 */

namespace Controller;


use View\HTMLTemplate;
use View\HTMLView;

class Comment extends Controller {
    public $routing = [
        'default' => 'Overview'
    ];

    public function Overview()
    {
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->addTemplate('COMMENTS', 'View/Templates/comment.html');
        return $this->template;
    }

} 