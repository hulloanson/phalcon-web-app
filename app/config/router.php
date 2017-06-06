<?php


use Phalcon\Mvc\Router;

$router = new Router();

// MVC routes
$router->setDefaultModule('frontend');

// API routes
$backend = new Router\Group([
    'module' => 'backend',
    'controller' => 'index'
]);

$backend->setPrefix('/api');

$backend->add(
    '/test',
    'Index::index'
);

// Simple GET, POST, DELETE
$backend->addGet(
    '/{controller}/all',
    [
        'controller' => 1,
        'action' => 'getAll'
    ]
);

$backend->addPost(
    '/{controller}',
    [
        'controller' => 1,
        'action' => 'addNew'
    ]
);

$backend->addDelete(
    '/{controller}/all',
    [
        'controller' => 1,
        'action' => 'deleteAll'
    ]
);

// Custom routes

$router->mount($backend);

return $router;