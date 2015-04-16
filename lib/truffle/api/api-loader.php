<?php

class ApiLoader{

    private $factory;
    
    public function __construct($factory){
        $this->factory = $factory;
    }
    
    public function load_api($api_name, $prefix, $require_from_simple_dir = true){
        $api_dir = './api/' . $api_name;
        $api_router = $api_dir . '/router.php';
        if(is_dir($api_dir) && is_file($api_router) && is_readable($api_router)){
            include $api_router;
            $raw_router = CaseParser::camelize(str_replace('-', '_', $api_name));
            $router_class = $raw_router . 'Router';
            $router = new $router_class();
            $api = $this->factory->create_api($prefix, $api_name, $require_from_simple_dir);
            $router->set_routes($api);
        }
    }

}