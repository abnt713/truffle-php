<?php

abstract class LemonadeGlass{
    
    private $lemonade_jug;
    
    public abstract function get();
    public abstract function post();
    public abstract function put();
    public abstract function delete();
    public abstract function patch();
    
    
    public function _method($callable_method_name){
        $this->inspect_method_name($method_name);
        
        $this->call_hook($method_name, 'pre_hook');
        $this->$callable_method_name();
        $this->pos_hook($method_name, 'pos_hook');
    }
    
    private function call_hook($method_name, $hook_time){
        $this->inspect_method_name($method_name);
        
        $hook_name = $method_name . '_' . $hook_time;
        if(method_exists($this, $hook_name)){
            $this->$hook_name();
        }
    }
    
    private function inspect_method_name($method_name){
        $available_methods = array(
            'get', 'post', 'put', 'delete', 'patch'
        );
        
        if(!in_array($method_name, $available_methods)){
            $this->error_handler->throw_error('Invalid callable method name');
        }
    }
}