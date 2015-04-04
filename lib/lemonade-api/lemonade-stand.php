<?php

class LemonadeStand{

    private static $instance;
    private $jugs;

    private function __construct(){
        $this->jugs = array();
    }

    public static function get_instance(){
        self::instantiate();
        return self::$instance;
    }

    private static function instantiate(){
        if(is_null(self::$instance)){
            self::$instance = new LemonadeStand();
        }
    }

    public static function create_jug($api_prefix = ''){
        self::instantiate();
        
        $created_jug = new LemonadeJug($api_prefix);
        self::$instance->jugs[] = $created_jug;
        return $created_jug;
    }

    public static function serve(){
        $stand = self::get_instance();
        
        foreach($stand->jugs as $jug){
            $jug->serve();
        }

        run();
    }
}