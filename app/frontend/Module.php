<?php


namespace Frontend;


use Phalcon\Loader;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine;
use Phalcon\Mvc\View\Engine\Volt;

class Module implements ModuleDefinitionInterface
{

    /**
     * Registers an autoloader related to the module
     *
     * @param mixed $dependencyInjector
     */
    public function registerAutoloaders(\Phalcon\DiInterface $dependencyInjector = null)
    {
        // TODO: Implement registerAutoloaders() method.
        $loader = new Loader();
        $loader->registerNamespaces([
            'Frontend\Controllers' => APP_PATH . '/frontend/controllers/',
            'Backend\Models' => APP_PATH . '/models'
        ]);
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
                $dispatcher->setDefaultNamespace('Frontend\Controllers');
                return $dispatcher;
            }
        );

        $di->set(
            "voltService",
            function ($view, $di) {
                $volt = new Volt($view, $di);

                $volt->setOptions(
                    [
                        "compiledPath" => $di->get("config")->get('application')->cacheDir,
                        "compiledExtension" => ".compiled",
                    ]
                );

                return $volt;
            }
        );

        $di->set(
            'view',
            function () {
                $view = new View();
                $view->setViewsDir('../app/frontend/views');
                $view->registerEngines(
                    [
                        ".volt" => "voltService",
                        ".phtml" => Engine\Php::class
                    ]

                );
                return $view;
            }
        );

    }
}