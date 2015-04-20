<?php

class PranchetaRouter{
    
    public function set_routes($api){
        $api->append('/', 'PiuController');
    }
    
}