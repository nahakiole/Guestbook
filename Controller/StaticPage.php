<?php


namespace Controller;


use Exception\PageNotFoundException;
use Model\Repository\Filter;
use Model\Repository\PageRepository;
use View\HTMLView;

class StaticPage extends Controller
{

    /**
     * @Inject
     * @var \PDO
     */
    public $db;

    /**
     * @Inject
     *
     * @param \PDO $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function showPage()
    {
        if ($_SERVER['REQUEST_URI'] != '/About') {
            throw new PageNotFoundException();
        }
        $pageRepository = new PageRepository($this->db);
        $pages = $pageRepository->findByFilter([new Filter('name', '=', substr($_SERVER['REQUEST_URI'], 1) )]);
        $this->template = new HTMLView('View/Templates/index.html');
        $this->template->template->setVariable(
            [
                'SITE_TITLE' => $pages[0]->getField('Title')->value,
                'CONTENT' => $pages[0]->getField('Content')->value,
                'SITE_DESC' => ''
            ]
        );
        return $this->template;
    }
}