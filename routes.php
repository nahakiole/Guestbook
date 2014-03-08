<?php
return [
    new \Model\Entity\Route('/^\/$/', '\Controller\Comment', 'Overview'),
    new \Model\Entity\Route('/^\/Test$/', '\Controller\Comment', 'Overview'),
    new \Model\Entity\Route('/^\/Overview$/', '\Controller\Comment', 'Overview'),
    new \Model\Entity\Route('/^\/Comment\/Json/', '\Controller\Comment', 'jsonAddComment'),
    new \Model\Entity\Route('/^\/Comment\/New/', '\Controller\Comment', 'checkForNewComments'),
    new \Model\Entity\Route('/^\/User\/Login/', '\Controller\User', 'userLogin'),
    new \Model\Entity\Route('/^\/Error\/404/', '\Controller\Error', 'notFound'),
    new \Model\Entity\Route('/^\/Error\/500/', '\Controller\Error', 'serverError'),
    new \Model\Entity\Route('/^\/[A-Za-z0-9]/', '\Controller\StaticPage', 'showPage')
];