<?php

class RoutesV1_Router{
    
    public function set_routes($prefix){
        $api = LemonadeFactory::create_api($prefix, 'routes-v1');
        
        $api->append('/', 'TestController');
//        $api->append('/testing', 'TestResource');
    }
    
}