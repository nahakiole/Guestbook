<?php
return [


// Defines an instance of My\Class
    'PDO' => DI\object()
            ->constructor(DI\link('db.config')
                , DI\link('db.user'), DI\link('db.password'), []
            ),
    'Error' => DI\object('\Controller\Error'),
    'comment' => DI\object('\Controller\Comment')

];