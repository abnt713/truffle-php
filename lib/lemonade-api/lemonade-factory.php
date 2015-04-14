<?php

class LemonadeFactory{

    private static $instance;
    private $apis;

    private function __construct(){
        $this->apis = array();
    }

    public static function get_instance(){
        self::instantiate();
        return self::$instance;
    }

    private static function instantiate(){
        if(is_null(self::$instance)){
            self::$instance = new LemonadeFactory();
        }
    }

    public static function create_api($api_prefix, $api_name){
        self::instantiate();
        
        $created_api = new LemonadeAPI($api_prefix, $api_name);
        self::$instance->apis[] = $created_api;
        return $created_api;
    }

    public static function serve(){
        $stand = self::get_instance();
        
        foreach($stand->apis as $api){
            $api->serve();
        }

        run();
    }
}