<?php

ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);

set_error_handler("handle_error");

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-factory.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-api.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-controller.php';
require_once __DIR__ . '/lib/truffle/api/truffle-app.php';
require_once __DIR__ . '/lib/truffle/api/truffle-api.php';
require_once __DIR__ . '/lib/truffle/api/truffle-factory.php';
require_once __DIR__ . '/lib/truffle/api/api-loader.php';
require_once __DIR__ . '/lib/truffle/utils/case-parser.php';
require_once __DIR__ . '/lib/truffle/utils/path-parser.php';
require_once __DIR__ . '/lib/truffle/utils/resource-loader.php';

ORM::configure('mysql:host=localhost;dbname=truffle');
ORM::configure('username', 'app');
ORM::configure('password', '123456abc');

TruffleApp::load_api('routes-v1', '/');
TruffleApp::serve();

function handle_error($errno, $errstr, $errfile, $errline){
    echo '"' . $errstr . '" - at ' . $errfile . ': ' . $errline;
}