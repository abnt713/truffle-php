<?php

class RouteLoader{
    
    public static function load_route($route_name){
        $route_file = __DIR__ . '/../../config/routes/' . $route_name . '.php';
        if(is_file($route_file) && is_readable($route_file)){
            include $route_file;
        }
    }
    
}