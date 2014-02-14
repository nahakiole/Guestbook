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
use View\JSONView;

class Comment extends Controller
{
    public $routing
        = [
            'default' => 'Overview',
            'json' => 'jsonAddComment'
        ];

    public function Overview()
    {
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => 'Willkommen auf meinem Gästebuch',
                'SITE_DESC' => 'Bitte trage dich ein oder lies die anderen spannenden Beiträge.'
            ]
        );
        $this->template->addTemplate('COMMENTS', new HTMLTemplate('View/Templates/comment.html'));
        $this->template->addTemplate('COMMENT_FORM', new HTMLTemplate('View/Templates/form.html'));
        $this->template->getTemplate('COMMENTS')->setVariable(['TXT_COMMENT_NAME' => 'Name:']);
        $this->template->getTemplate('COMMENTS')->setBlockVariable('COMMENT_NAME', 'Robin');
        $this->template->getTemplate('COMMENTS')->preRender();
        $this->template->getTemplate('COMMENTS')->nextBlock();
        $this->template->getTemplate('COMMENTS')->setBlockVariable('COMMENT_NAME', 'Nicolas');
        $this->template->getTemplate('COMMENTS')->preRender();
        return $this->template;
    }

    public function jsonAddComment()
    {
        $this->template = new JSONView();
        $this->template->jsonData = new \stdClass();
        $this->template->jsonData->message = [
            'success'
        ];
        return $this->template;
    }

} 