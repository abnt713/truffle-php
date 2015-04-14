<?php

class ApiLoader{
    
    public static function load_api($api_name, $prefix){
        $api_dir = './api/' . $api_name;
        $api_routes = $api_dir . '/router.php';
        if(is_dir($api_dir) && is_file($api_routes) && is_readable($api_routes)){
            include $api_routes;
            $raw_router = CaseParser::camelize(str_replace('-', '_', $api_name));
            $router_class = $raw_router . '_Router';
            $router = new $router_class();
            
            $router->set_routes($prefix);
        }
    }
    
}