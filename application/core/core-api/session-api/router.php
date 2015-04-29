<?php

define('SESSION_TIME_IN_MINUTES', 30);
SharedLibLoader::require_from_api('TruffleSession', 'session-api', _DEFAULT_API_DIR);

class SessionApiRouter implements TruffleRouter{
    
    public function set_routes($api){
        $api->append('/', 'SessionController', _DEFAULT_API_DIR);
    }

}
