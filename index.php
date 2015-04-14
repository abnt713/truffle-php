<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-factory.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-api.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-controller.php';
require_once __DIR__ . '/lib/truffle/api-loader.php';
require_once __DIR__ . '/lib/truffle/utils/case-parser.php';


ApiLoader::load_api('routes-v1');
LemonadeFactory::serve();