<?php

// Logging - Set to false in production environment
ORM::configure('logging', true);

// Default PDO DSN
ORM::configure('mysql:host=localhost;dbname=truffle');

// Database username
ORM::configure('username', 'app');

// Database password
ORM::configure('password', '123456abc');