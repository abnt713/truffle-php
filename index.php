<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-stand.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-jug.php';
require_once __DIR__ . '/lib/lemonade-api/lemonade-resource.php';
require_once __DIR__ . '/api/resources/v1/test-resource.php';
require_once __DIR__ . '/lib/truffle/route-loader.php';


RouteLoader::load_route('routes-v1');
LemonadeStand::serve();