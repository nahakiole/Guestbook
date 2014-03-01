<?php
return [


// Defines an instance of My\Class
    'mysqli' => DI\object()
            ->constructor(
                DI\link('db.host'), DI\link('db.user'), DI\link('db.password'), DI\link('db.database'),
                DI\link('db.port'), DI\link('db.socket')
            ),

    'default' => DI\object('\Controller\Comment'),
    'Error' => DI\object('\Controller\Error'),
    'comment' => DI\object('\Controller\Comment')
//    'My\OtherClass' => DI\object()
//            ->scope(Scope::PROTOTYPE())
//            ->constructor(DI\link('db.host'), DI\link('db.port'))
//            ->method('setFoo2', DI\link('My\Foo1'), DI\link('My\Foo2'))
//            ->property('bar', 'My\Bar'),
//
//// Define only specific parameters
//    'My\AnotherClass' => DI\object()
//            ->constructorParameter('someParam', 'value to inject')
//            ->methodParameter('setFoo2', 'someParam', DI\link('My\Foo')),
//
//// Mapping an interface to an implementation
//    'My\Interface' => DI\object('My\Implementation'),
//
//// Defining a named instance
//    'myNamedInstance' => DI\object('My\Class'),
//
//// Using an anonymous function
//    'My\Stuff' => DI\factory(function (Container $c) {
//            return new MyClass($c->get('db.host'));
//        }),
//
//// Defining an alias to another entry
//    'some.entry' => DI\link('some.other.entry'),

];