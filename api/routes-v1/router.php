<?php

class RoutesV1Router{
    
    public function set_routes($api){
        $api->append('/', 'TestController');
        $api->append('/test', 'TestingController');
    }
    
}