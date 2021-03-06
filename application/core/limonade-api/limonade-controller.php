<?php

abstract class LimonadeController{
    
    protected $limonade_api;
    
    public function set_limonade_api($api){
        $this->limonade_api = $api;
    }
    
    public function get_api_name(){
        return $this->limonade_api->get_api_name();
    }
    
    public function get(){ return ; }
    public function post(){ return ; }
    public function put(){ return ; }
    public function delete(){ return ; }
    public function patch(){ return ; }
    
    public function _get(){
        $this->_method('get');
    }
    
    public function _post(){
        $this->_method('post');
    }
    
    public function _put(){
        $this->_method('put');
    }
    
    public function _delete(){
        $this->_method('delete');
    }
    
    public function _patch(){
        $this->_method('patch');
    }
    
    private function _method($callable_method_name){
        $this->inspect_method_name($callable_method_name);
        $this->call_hook('global', 'pre_hook');
        $pre_hook = $this->call_hook($callable_method_name, 'pre_hook');
        if($pre_hook || is_null($pre_hook)){
            $this->$callable_method_name();
        }
        $this->call_hook($callable_method_name, 'pos_hook');
        $this->call_hook('global', 'pos_hook');
    }
    
    private function call_hook($method_name, $hook_time){
        $this->inspect_method_name($method_name);
        
        $hook_name = $method_name . '_' . $hook_time;
        if(method_exists($this, $hook_name)){
            $this->$hook_name();
        }else{
            return true;
        }
    }
    
    private function inspect_method_name($method_name){
        $available_methods = array(
            'get', 'post', 'put', 'delete', 'patch'
        );
        
        if(!in_array($method_name, $available_methods)){
            trigger_error('Method not found');
        }
    }
}