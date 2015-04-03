<?php

class LemonadeJug{
    
    private $assignments;
    
    public function __construct(){
        $this->assignments = array();
    }
    
    public function assign($route, LemonadeResource $resource){
        if(!array_key_exists($route, $this->assignments)){
            $this->assignments[$route] = $resource;
        }else{
            $this->throw_error('Route already defined');
        }
    }
    
    public function throw_error($error, $halt = true){
        die($error);
    }
    
    public function serve(){
        $this->process_assignments();
        run();
    }
    
    private function process_assignments(){
        foreach($this->assignments as $index => $resource){
            dispatch_get($index, array($resource, '_get'));
            dispatch_post($index, array($resource, '_post'));
            dispatch_put($index, array($resource, '_put'));
            dispatch_delete($index, array($resource, '_delete'));
            dispatch_patch($index, array($resource, '_patch'));
        }
    }
    
}