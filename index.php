<?php
require_once 'application/core/inc.php';
require_once 'application/config/db.php';

TruffleApp::load_api('routes-v1', '/');
TruffleApp::load_api('prancheta', '/tyna');
TruffleApp::load_api('scheme-parser', '/scheme-parser');
TruffleApp::serve();