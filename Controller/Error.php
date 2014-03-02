<?php

namespace Controller;


class Error extends Controller
{



    public function notFound()
    {
        $this->template = new \View\HTMLView('View/Templates/index.html');
        $this->template->setHeader('HTTP/1.0 404 Not Found');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => 'Da ging etwas daneben.',
                'SITE_DESC' => 'Diese Seite wurde nicht gefunden.'
            ]
        );
        return $this->template;
    }

    public function serverError()
    {
        $this->template = new \View\HTMLView('View/Templates/index.html');
        $this->template->setHeader('HTTP/1.0 500');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => 'Da ging etwas daneben.',
                'SITE_DESC' => 'Ein Fehler ist aufgetreten.'
            ]
        );
        return $this->template;
    }

}
