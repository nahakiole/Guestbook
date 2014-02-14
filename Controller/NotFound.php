<?php
/**
 * Created by PhpStorm.
 * User: Robin
 * Date: 14.02.14
 * Time: 21:03
 */

namespace Controller;
use View\HTMLTemplate;
use View\HTMLTemplateBlock;
use View\HTMLView;

class NotFound extends Controller {
    public $routing = [
        'default' => 'notFound'
    ];

    public function notFound(){
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->template->setVariable([
                'SITE_TITLE' => 'Da ging etwas daneben.',
                'SITE_DESC' => 'Diese Seite wurde nicht gefunden.'
            ]);
        return $this->template;
    }
} 