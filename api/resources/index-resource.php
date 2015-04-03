<?php

class IndexResource extends LemonadeResource{
    
    public function get(){
        echo 'Testing GET';    
    }
    
    public function post(){
        echo 'Testing POST';
    }
    
    public function put(){
        echo 'Testing PUT';
    }
    
    public function delete(){
        echo 'Testing DELETE';
    }
    
    public function patch(){
        echo 'Testing PATCH';
    }
}