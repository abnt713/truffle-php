<?php

class AccountApiRouter implements TruffleRouter{
    
    public function set_routes($api){
        $api->append('/', 'AccountController', _DEFAULT_API_DIR);
    }

}
