<?php

namespace Controller;


use Exception\PageNotFoundException;
use Exception\ServerErrorException;
use Model\Entity\Field;
use Model\Repository\CommentRepository;
use Model\Repository\Filter;
use View\BootstrapGenerator;
use View\HTMLForm;
use View\HTMLTemplate;
use View\HTMLView;
use View\JavascriptView;

class Comment extends Controller
{
    /**
     * @Inject
     * @var \PDO
     */
    public $db;

    /**
     * @var CommentRepository
     */
    private $commentRepository;

    /**
     * @Inject
     *
     * @param \PDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function Overview()
    {
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => 'Willkommen auf meinem Gästebuch',
                'SITE_DESC' => 'Bitte trage dich ein oder lies die anderen spannenden Beiträge.'
            ]
        );
        $this->template->addTemplate(
            'CONTENT', new HTMLTemplate('View/Templates/comment.html')
        );
        $commentForm = $this->getCommentForm();
        $this->template->addTemplate('COMMENT_FORM', $commentForm);
        if ($commentForm->isValid()) {
            $this->addComment($commentForm->getEntity());
            $commentForm->clearValues();
        }

        $commentRepository = new CommentRepository($this->db);
        $comments = $commentRepository->findAll();
        if (count($comments) !== 0) {
            $this->template->addTemplate(
                'SINGLE_COMMENT',
                new HTMLTemplate('View/Templates/single_comment.html')
            );
            $this->template->getTemplate('SINGLE_COMMENT')->setVariable(
                [
                    'TXT_COMMENT_NAME' => 'Name:',
                    'TXT_COMMENT_ADDRESS' => 'Adresse:',
                    'TXT_COMMENT_EMAIL' => 'E-Mail:',
                    'TXT_COMMENT_CONTENT' => 'Kommentar:'
                ]
            );
            foreach ($comments as $comment) {
                $this->template->getTemplate('SINGLE_COMMENT')
                    ->setBlockVariable(
                    [
                        'COMMENT_NAME' => $comment->getField('Name')->value,
                        'COMMENT_ADRESS' => $comment->getField('Ort')->value,
                        'COMMENT_URL' => $comment->getField('URL')->value,
                        'COMMENT_CONTENT' => $comment->getField(
                                'Kommentar'
                            )->value,
                        'COMMENT_EMAIL' => $comment->getField('Email')->value
                    ]
                );
                $this->template->getTemplate('SINGLE_COMMENT')->preRender();
            }
        }
        else {
            $this->template->getTemplate('COMMENTS')->setVariable(['NO_COMMENTS' => '<div class="col-lg-6 no-entries">Keine Einträge vorhanden</div>']);
        }
        return $this->template;
    }

    public function getCommentForm()
    {
        return new HTMLForm('comment', new BootstrapGenerator(), new \Model\Entity\Comment(
            new Field('Name'),
            new Field('Ort'),
            new Field('Email', Field::TYPE_EMAIL, FILTER_VALIDATE_EMAIL),
            new Field('URL', Field::TYPE_TEXT, FILTER_VALIDATE_URL),
            new Field('Kommentar', Field::TYPE_TEXTAREA)
        ));
    }

    public function jsonAddComment()
    {
        $commentForm = $this->getCommentForm();
        $this->template = new JavascriptView();
        $this->template->content = $commentForm->getJavascript();
        if ($commentForm->isValid()) {
            $this->addComment($commentForm->getEntity());
            $this->template->content .= "jQuery( \"#comment .form-control\" ).val('');\n";
        }
        return $this->template;
    }

    public function checkForNewComments()
    {
        $this->template = new JavascriptView();
        $this->commentRepository = new CommentRepository($this->db);
        $after = isset($_GET['after']) ?  intval($_GET['after']) : date('U');
        $comments = $this->getCommentsSince($after);
        $render = '';
        if (count($comments) > 0) {
            $commentHTML
                = new HTMLTemplate('View/Templates/single_comment.html');
            $commentHTML->setVariable(
                [
                    'TXT_COMMENT_NAME' => 'Name:',
                    'TXT_COMMENT_ADDRESS' => 'Adresse:',
                    'TXT_COMMENT_EMAIL' => 'E-Mail:',
                    'TXT_COMMENT_URL' => 'Url:',
                    'TXT_COMMENT_CONTENT' => 'Kommentar:'
                ]
            );
            foreach ($comments as $comment) {
                $commentHTML->setBlockVariable(
                    [
                        'COMMENT_NAME' => $comment->getField('Name')->value,
                        'COMMENT_ADRESS' => $comment->getField(
                                'Ort'
                            )->value,
                        'COMMENT_EMAIL' => $comment->getField(
                                'Email'
                            )->value,
                        'COMMENT_URL' => $comment->getField('URL')->value,
                        'COMMENT_CONTENT' => $comment->getField(
                                'Kommentar'
                            )->value
                    ]
                );
                $commentHTML->setBlockVariable(
                    ['COMMENT_VISIBLE' => 'js-comment-fadein']
                );
                $commentHTML->preRender();
                $render = preg_replace(
                    '/^\s+|\n|\r|\s+$/m', '', $commentHTML->render()
                );
            }
            $this->template->content .= "jQuery( \".comment\" ).parent().append( '$render' );\n";
            $this->template->content .= "jQuery( \".no-entries\" ).fadeOut();\n";
            $this->template->content .= "jQuery( \".js-comment-fadein\" ).fadeIn();\n";
            $this->template->content .= "jQuery( \".single-comment\" ).removeClass(\".js-comment-fadein\");\n";
        }
        else {

        }
        return $this->template;
    }

    /**
     * @param $comment \Model\Entity\Comment
     */
    public function addComment($comment)
    {
        $comment->sanatizeField();
        $this->db->query(
            "INSERT INTO `Entry` (`id`, `name`, `place`, `mail`, `url`, `comment`, `date`)
                    VALUES (NULL, '" . $comment->getField('Name')->value . "',
         '" . $comment->getField('Ort')->value . "',
         '" . $comment->getField('Email')->value . "',
         '" . $comment->getField('URL')->value . "',
         '" . $comment->getField('Kommentar')->value . "',
         '" . date('Y-m-d H:i:s') . "'
         );"
        );
    }

    /**
     * @param $after
     *
     * @return \Model\Entity\Comment[]
     */
    public function getCommentsSince($after){
        $comments = $this->commentRepository->findByFilter([
                new Filter('date', '>', date('Y-m-d H:i:s', $after))
            ]
        );
        if (count($comments) == 0){
            sleep(0.2);
            $comments = $this->getCommentsSince($after);
        }
        return $comments;
    }

} 