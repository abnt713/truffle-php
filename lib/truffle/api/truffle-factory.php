<?php

class TruffleFactory extends LemonadeFactory{
    
    // @Override
    public function instantiate_api($api_prefix, $api_name){
        return new TruffleAPI($api_prefix, $api_name);
    }
    
}