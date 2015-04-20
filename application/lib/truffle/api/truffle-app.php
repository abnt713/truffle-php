<?php

class TruffleApp{
    
    private static $instance;
    private $api_loader;
    private $factory;
    
    private function __construct(){
        $this->factory = new TruffleFactory();
        $this->api_loader = new ApiLoader($this->factory);
    }
    
    private static function get_instance(){
        self::instantiate();
        return self::$instance;
    }
    
    public static function instantiate(){
        if(is_null(self::$instance)){
            self::$instance = new TruffleApp();
        }
    }
    
    public static function load_api($api_name, $prefix){
        $self = self::get_instance();
        $api_loader = $self->api_loader;
        $api_loader->load_api($api_name, $prefix);
    }
    
    public static function serve(){
        $factory = self::get_instance()->factory;
        $factory->serve();
    }
    
    public static function default_filter_paths(){
        return array(
            './application/lib/truffle/filter'
        );
    }
    
}