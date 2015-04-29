<?php

/************************************/
/***     Inc - Required files     ***/
/************************************/

// Composer autoload
require_once 'vendor/autoload.php';

// Lemonade API
require_once 'application/core/limonade-api/limonade-factory.php';
require_once 'application/core/limonade-api/limonade-api.php';
require_once 'application/core/limonade-api/limonade-controller.php';

// Struct libs
require_once 'application/core/struct/controller/json-controller.php';
require_once 'application/core/struct/controller/controller-outcomes.php';
require_once 'application/core/struct/controller/assert-controller.php';
require_once 'application/core/struct/model/scheme/model-scheme.php';
require_once 'application/core/struct/model/scheme/scheme-column.php';
require_once 'application/core/struct/utils/case-parser.php';
require_once 'application/core/struct/utils/path-parser.php';
require_once 'application/core/struct/utils/resource-loader.php';
require_once 'application/core/struct/validator/raw-validator.php';
require_once 'application/core/struct/model/raw-model.php';
require_once 'application/core/struct/filter/validation-filter.php';

// Truffle API
require_once 'application/core/truffle/api/truffle-app.php';
require_once 'application/core/truffle/api/truffle-api.php';
require_once 'application/core/truffle/api/truffle-factory.php';
require_once 'application/core/truffle/api/api-loader.php';
require_once 'application/core/truffle/api/model-loader.php';
require_once 'application/core/truffle/api/shared-loader.php';
require_once 'application/core/truffle/api/truffle-controller.php';
require_once 'application/core/truffle/api/truffle-model.php';
require_once 'application/core/truffle/api/truffle-router.php';

// Truffle Components
require_once 'application/core/truffle/validator/filter-validator.php';

// Truffle functions
require_once 'application/core/functions.php';

define('_DEFAULT_API_DIR', './application/core/core-api');

// Include default APIs
require_once _DEFAULT_API_DIR . '/inc.php';
