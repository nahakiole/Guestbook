<?php
return [
    new \Model\Entity\Route('/^\/$/', 'comment', 'Overview'),
    new \Model\Entity\Route('/^\/Overview$/', 'comment', 'Overview'),
    new \Model\Entity\Route('/^\/comment\/json/', 'comment', 'json')
];