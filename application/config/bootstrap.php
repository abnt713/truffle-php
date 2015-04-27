<?php

function server_error($errno, $errstr, $errfile=null, $errline=null)
{
    $args = compact('errno', 'errstr', 'errfile', 'errline');
    echo '<pre>';
    var_dump($args);
    echo '</pre>';
}