<?php

/*
 * Modified: preppend directory path of current file, because of this file own different ENV under between Apache and command line.
 * NOTE: please remove this comment.
 */
defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

function getBaseUrl()
{
  $protocol = $_SERVER['HTTPS'] == 'on' ? 'https://' : 'http://'; // Protocol
  $webDir = pathinfo($_SERVER['PHP_SELF'])['dirname']; // Web dir the app is under
  return "{$protocol}{$_SERVER['HTTP_HOST']}{$webDir}/";
}

return new \Phalcon\Config([
    'mongodb' => [
        'host' => 'localhost',
        'port' => 27017,
        'username' => 'conman',
        'password' => 'conmanapp',
        'database' => 'conapp'
    ],
    'application' => [
        'appDir' => APP_PATH . '/',
        'pluginsDir' => APP_PATH . '/plugins/',
        'libraryDir' => APP_PATH . '/library/',
        'cacheDir' => BASE_PATH . '/cache/',
        'baseUri' => getBaseUrl()
    ]
]);
