<?php

class LemonadeAPI{

    private $prefix;
    private $assignments;
    private $api_name;

    public function __construct($prefix, $api_name){
        $this->prefix = $prefix;
        $this->assignments = array();
        $this->api_name = $api_name;
    }
    
    public function get_api_name(){
        return $this->api_name;
    }
    
    public function append($route, $controller_class){
        if(!array_key_exists($route, $this->assignments)){
            $this->assignments[$route] = $controller_class;
        }else{
            die('Route already defined');
        }
    }

    public function serve(){
        $this->process_assignments();
    }

    protected function process_assignments(){
        foreach($this->assignments as $raw_index => $raw_controller){
            $index = PathParser::get_undashed($this->prefix) . $raw_index;
            $controller = new $raw_controller();

            dispatch_get($index, array($controller, '_get'));
            dispatch_post($index, array($controller, '_post'));
            dispatch_put($index, array($controller, '_put'));
            dispatch_delete($index, array($controller, '_delete'));
            dispatch_patch($index, array($controller, '_patch'));
        }
    }
}