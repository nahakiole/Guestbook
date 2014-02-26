<?php

namespace Controller;


use Model\Entity\Field;
use View\BootstrapGenerator;
use View\HTMLForm;
use View\HTMLTemplate;
use View\JavascriptView;

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
        $this->template->addTemplate('COMMENTS', new HTMLTemplate('View/Templates/comment.html'));
        $commentForm = $this->getCommentForm();
        $this->template->addTemplate('COMMENT_FORM', $commentForm);
        if ($commentForm->isValid()) {

        }

    /*    $this->template->addTemplate('SINGLE_COMMENT', new HTMLTemplate('View/Templates/single_comment.html'));
        $this->template->getTemplate('SINGLE_COMMENT')->setVariable(
            [
                'TXT_COMMENT_NAME' => 'Name:',
                'TXT_COMMENT_ADDRESS' => 'Adresse:',
                'TXT_COMMENT_EMAIL' => 'E-Mail:',
                'TXT_COMMENT_CONTENT' => 'Kommentar:'
            ]
        );
        $this->template->getTemplate('SINGLE_COMMENT')->setBlockVariable(['COMMENT_NAME' => 'Robin']);
        $this->template->getTemplate('SINGLE_COMMENT')->preRender();*/

        return $this->template;
    }

    /**
     *
     */
    public function getCommentForm()
    {
        return new HTMLForm('comment', new BootstrapGenerator(), new \Model\Entity\Comment(
            new Field('Name'), new Field('Ort'), new Field('Email', Field::TYPE_EMAIL, FILTER_VALIDATE_EMAIL), new Field('URL', Field::TYPE_TEXT, FILTER_VALIDATE_URL), new Field('Kommentar', Field::TYPE_TEXTAREA)
        ));
    }

    public function jsonAddComment()
    {
        $commentForm = $this->getCommentForm();
        $this->template = new JavascriptView();
        $this->template->content = $commentForm->getJavascript();
        if ($commentForm->isValid()) {
            $comment = new HTMLTemplate('View/Templates/single_comment.html');
            $comment->setVariable(
                [
                    'TXT_COMMENT_NAME' => 'Name:',
                    'TXT_COMMENT_ADDRESS' => 'Adresse:',
                    'TXT_COMMENT_EMAIL' => 'E-Mail:',
                    'TXT_COMMENT_URL' => 'Url:',
                    'TXT_COMMENT_CONTENT' => 'Kommentar:'
                ]
            );
            $comment->setBlockVariable(
                [
                    'COMMENT_NAME' => $commentForm->getField('Name')->value,
                    'COMMENT_ADRESS' => $commentForm->getField('Ort')->value,
                    'COMMENT_EMAIL' => $commentForm->getField('Email')->value,
                    'COMMENT_URL' => $commentForm->getField('URL')->value,
                    'COMMENT_CONTENT' => $commentForm->getField('Kommentar')->value
                ]);
            $comment->setBlockVariable(['COMMENT_VISIBLE' => 'js-comment-fadein']);
            $comment->preRender();
            $render = preg_replace('/^\s+|\n|\r|\s+$/m', '', $comment->render());
            $this->template->content .= "jQuery( \".comment\" ).parent().append( '$render' );\n";
            $this->template->content .= "jQuery( \".js-comment-fadein\" ).fadeIn();\n";
        }
        return $this->template;
    }

} 