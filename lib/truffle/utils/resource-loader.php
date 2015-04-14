<?php

class ResourceLoader{
    
    private $working_dir;
    
    public function __construct($working_dir = '.'){
        $this->working_dir = $working_dir;
    }
    
    public function _require($resource){
        require_once $this->working_dir . $resource;
    }
    
}