<?php

require_once __DIR__ . '/vendor/autoload.php';

dispatch('/', 'hello');
function hello()
{
    echo 'Hello, world!';
}

dispatch('/algo', 'algo');
function algo(){
    echo 'Método diferente';
}

run();