<?php
return [
    new \Model\Entity\Route('/^\/$/', 'comment', 'Overview'),
    new \Model\Entity\Route('/^\/Overview$/', 'comment', 'Overview'),
    new \Model\Entity\Route('/^\/Comment\/Json/', 'comment', 'jsonAddComment'),
    new \Model\Entity\Route('/^\/Comment\/New/', 'comment', 'checkForNewComments'),
    new \Model\Entity\Route('/^\/Error\/404/', '\Controller\Error', 'notFound'),
    new \Model\Entity\Route('/^\/Error\/500/', '\Controller\Error', 'serverError')
];