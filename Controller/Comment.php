<?php

namespace Controller;


class Comment extends Controller
{
    public $routing
        = [
            'default' => 'Overview',
            'json' => 'jsonAddComment'
        ];

    public function Overview()
    {
        $this->template = new \View\HTMLView('View/Templates/index.html');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => 'Willkommen auf meinem Gästebuch',
                'SITE_DESC' => 'Bitte trage dich ein oder lies die anderen spannenden Beiträge.'
            ]
        );
        $this->template->addTemplate('COMMENTS', new \View\HTMLTemplate('View/Templates/comment.html'));
        $this->template->addTemplate('COMMENT_FORM', new \View\HTMLTemplate('View/Templates/form.html'));


        $this->template->addTemplate('SINGLE_COMMENT', new \View\HTMLTemplate('View/Templates/single_comment.html'));
        $this->template->getTemplate('SINGLE_COMMENT')->setVariable(
            [
                'TXT_COMMENT_NAME' => 'Name:',
                'TXT_COMMENT_ADDRESS' => 'Adresse:',
                'TXT_COMMENT_EMAIL' => 'E-Mail:',
                'TXT_COMMENT_CONTENT' => 'Kommentar:'
            ]
        );
        $this->template->getTemplate('SINGLE_COMMENT')->setBlockVariable(['COMMENT_NAME' => 'Robin']);
        $this->template->getTemplate('SINGLE_COMMENT')->preRender();

        return $this->template;
    }

    public function jsonAddComment()
    {
        sleep(1);
        $this->template = new \View\JSON();
        $this->template->jsonData = new \stdClass();
        $this->template->jsonData->message = [
            'success',
            'data' => $_POST,
            'error' => 'Bitte Namen angeben'
        ];
        return $this->template;
    }

} 