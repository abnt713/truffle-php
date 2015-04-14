<?php

require_once __DIR__ . '/../../api/resources/v1/test-resource.php';

$route = LemonadeStand::create_jug('/api/v1/', 'routes-v1');

$route->append('/', 'TestResource');
$route->append('/testing', 'TestResource');