<?php

use Phalcon\Flash\Direct as Flash;
use Phalcon\Mvc\Model\Metadata\Memory as MetaDataAdapter;
use Phalcon\Mvc\Url as UrlResolver;
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;
use Phalcon\Session\Adapter\Files as SessionAdapter;

/**
 * Shared configuration service
 */
$di->setShared('config', function () {
    return require __DIR__ . "/config.php";
});

/**
 * The URL component is used to generate all kind of urls in the application
 */
$di->setShared('url', function () {

    $url = new UrlResolver();
    $url->setBaseUri($this->get("config")->get('application')->baseUri);

    return $url;
});

/**
 * If the configuration specify the use of metadata adapter use it or use memory otherwise
 */
$di->setShared('modelsMetadata', function () {
    return new MetaDataAdapter();
});

///** TODO remove if useless
// * Register the session flash service with the Twitter Bootstrap classes
// */
//$di->set('flash', function () {
//    return new Flash([
//        'error' => 'alert alert-danger',
//        'success' => 'alert alert-success',
//        'notice' => 'alert alert-info',
//        'warning' => 'alert alert-warning'
//    ]);
//});

/**
 * Start the session the first time some component request the session service
 */
$di->setShared('session', function () {
    $session = new SessionAdapter();
    $session->start();

    return $session;
});


$di->setShared('mongo', function () {
    $config = $this->get('config')->mongodb;
    $client = new MongoClient(
        "mongodb://"
        . $config['username'] . ':' . $config['password'] . '@'
        . $config['host'] . ':' . $config['port']
        . '/' . $config['database']
    );
//
    return $client->selectDB($config['database']);

});

$di->setShared('collectionManager', function () {
    return new \Phalcon\Mvc\Collection\Manager();
});
