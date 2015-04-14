<?php

class ApiLoader{

    public static function load_api($api_name, $prefix, $require_on_demand = true){
        $api_dir = './api/' . $api_name;
        $api_router = $api_dir . '/router.php';
        if(is_dir($api_dir) && is_file($api_router) && is_readable($api_router)){
            include $api_router;
            $raw_router = CaseParser::camelize(str_replace('-', '_', $api_name));
            $router_class = $raw_router . '_Router';
            $router = new $router_class();
            $api = LemonadeFactory::create_api($prefix, $api_name, $require_on_demand);
            $router->set_routes($api);
        }
    }

}