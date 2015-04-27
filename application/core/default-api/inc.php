<?php

define('_DEFAULT_API_DIR', './application/core/default-api');

TruffleApp::load_api('account-api', '/account', _DEFAULT_API_DIR);
TruffleApp::load_api('group-api', '/group', _DEFAULT_API_DIR);
TruffleApp::load_api('session-api', '/session', _DEFAULT_API_DIR);
TruffleApp::load_api('permission-api', '/permission', _DEFAULT_API_DIR);
