<?php

class LemonadeJug{
    
    private $prefix;
    private $assignments;
    private $resource_path;
    
    public function __construct($prefix = '', $resource_path = null){
        $this->prefix = $prefix;
        $this->assignments = array();
        $this->resource_path = $resource_path;
    }
    
    public function append($route, $resource_class){
        if(!array_key_exists($route, $this->assignments)){
            $this->assignments[$route] = $resource_class;
        }else{
            $this->throw_error('Route already defined');
        }
    }
    
    public function throw_error($error, $halt = true){
        die($error);
    }
    
    public function serve(){
        $this->process_assignments();
    }
    
    private function process_assignments(){
        foreach($this->assignments as $raw_index => $raw_resource){
            
            $index = $this->get_undashed_prefix() . $raw_index;
            $resource = new $raw_resource();
            
            dispatch_get($index, array($resource, '_get'));
            dispatch_post($index, array($resource, '_post'));
            dispatch_put($index, array($resource, '_put'));
            dispatch_delete($index, array($resource, '_delete'));
            dispatch_patch($index, array($resource, '_patch'));
        }
    }
    
    private function get_undashed_prefix(){
        if(substr($this->prefix, -1, 1) == '/'){
            return substr($this->prefix, 0, strlen($this->prefix) - 1);
        }else{
            return $this->prefix;
        }
    }
    
}