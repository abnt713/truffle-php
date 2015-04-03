<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/lib/jug/lemonade-jug.php';
require_once __DIR__ . '/lib/jug/lemonade-resource.php';

require_once __DIR__ . '/api/resources/index-resource.php';

$jug = new LemonadeJug();

$jug->assign('/test', new IndexResource());
$jug->serve();

//dispatch('/', 'hello');
//function hello()
//{   
//    echo 'Hello, world!';
//}
//
//dispatch('/algo/aninha/linda/vida', 'algo');
//function algo(){
//    echo 'It\'s True';
//}
//
//run();