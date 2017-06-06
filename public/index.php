<?php
error_reporting(E_ALL);
ini_set('display_errors', true);

use Phalcon\Di\FactoryDefault;
use Phalcon\Mvc\Application;

define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

try {
    $di = new FactoryDefault();

    /**
     * Read services
     */
    include APP_PATH . "/config/services.php"; // It includes /config/config.php

    // Specific routes for modules
    $di->set(
        "router",
        function () {
            return require APP_PATH . '/config/router.php';
        }
    );

// Create an application
    $application = new Application($di);

// Register the installed modules
    $application->registerModules(
        [
            "frontend" => [
                "className" => 'Frontend\Module',
                "path" => APP_PATH . "/frontend/Module.php",
            ],
            "backend" => [
                "className" => 'Backend\Module',
                "path" => APP_PATH . "/backend/Module.php",
            ]
        ]
    );
    // Handle the request
    $response = $application->handle();
    $response->send();
} catch (\Exception $e) {
    echo $e->getMessage();
}