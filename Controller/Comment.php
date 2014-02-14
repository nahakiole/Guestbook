<?php
/**
 * Created by PhpStorm.
 * User: robin
 * Date: 11.02.14
 * Time: 11:21
 */

namespace Controller;


use View\HTMLTemplate;
use View\HTMLTemplateBlock;
use View\HTMLView;

class Comment extends Controller {
    public $routing = [
        'default' => 'Overview'
    ];

    public function Overview()
    {
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->addTemplate('COMMENTS', new HTMLTemplate('View/Templates/comment.html') );
        $this->template->getTemplate('COMMENTS')->setVariable(['TXT_COMMENT_NAME' => 'Name:']);
        $this->template->getTemplate('COMMENTS')->setBlockVariable('COMMENT_NAME', 'Robin');
        $this->template->getTemplate('COMMENTS')->preRender();
        $this->template->getTemplate('COMMENTS')->nextBlock();
        $this->template->getTemplate('COMMENTS')->setBlockVariable('COMMENT_NAME', 'Nicolas');
        $this->template->getTemplate('COMMENTS')->preRender();
        return $this->template;
    }

} 