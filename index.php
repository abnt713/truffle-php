<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/application/lib/limonade-api/limonade-factory.php';    
require_once __DIR__ . '/application/lib/limonade-api/limonade-api.php';
require_once __DIR__ . '/application/lib/limonade-api/limonade-controller.php';
require_once __DIR__ . '/application/lib/truffle/api/truffle-app.php';
require_once __DIR__ . '/application/lib/truffle/api/truffle-api.php';
require_once __DIR__ . '/application/lib/truffle/api/truffle-factory.php';
require_once __DIR__ . '/application/lib/truffle/api/api-loader.php';
require_once __DIR__ . '/application/lib/struct/model/scheme/model-scheme.php';
require_once __DIR__ . '/application/lib/struct/model/scheme/scheme-column.php';
require_once __DIR__ . '/application/lib/struct/utils/case-parser.php';
require_once __DIR__ . '/application/lib/struct/utils/path-parser.php';
require_once __DIR__ . '/application/lib/struct/utils/resource-loader.php';
require_once __DIR__ . '/application/lib/struct/validator/raw-validator.php';
require_once __DIR__ . '/application/lib/struct/model/raw-model.php';
require_once __DIR__ . '/application/lib/truffle/validator/filter-validator.php';
require_once __DIR__ . '/application/lib/truffle/truffle-controller.php';
require_once __DIR__ . '/application/lib/truffle/model/truffle-model.php';
require_once __DIR__ . '/application/lib/struct/filter/validation-filter.php';

ORM::configure('logging', true);
ORM::configure('mysql:host=localhost;dbname=truffle');
ORM::configure('username', 'app');
ORM::configure('password', '123456abc');

TruffleApp::load_api('routes-v1', '/');
TruffleApp::load_api('prancheta', '/tyna');
TruffleApp::serve();