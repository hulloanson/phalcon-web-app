<?php

namespace Backend;

use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param mixed $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {
        $loader = new Loader();
        $loader->registerNamespaces(
            [
                'Backend\Controllers' => APP_PATH . '/backend/controllers/',
                'Backend\Models' => APP_PATH . '/models/'
            ]
        );
        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param mixed $di
     */
    public function registerServices(\Phalcon\DiInterface $di)
    {
        // Add dispatcher
        $di->set(
            'dispatcher',
            function () {
                $dispatcher = new Dispatcher();
                $dispatcher->setDefaultNamespace('Backend\Controllers');
                return $dispatcher;
            }
        );
        $di->set(
            'view',
            function () {
                $view = new View();
                $view->setRenderLevel(View::LEVEL_NO_RENDER);
                return $view;
            }
        );

    }
}