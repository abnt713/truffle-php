<?php

require_once __DIR__ . '/vendor/autoload.php';

dispatch('/:name', 'hello');
  function hello()
  {
      echo 'Hello, ' . params('name');
  }
run();