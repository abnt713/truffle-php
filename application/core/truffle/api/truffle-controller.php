<?php

class TruffleController extends LimonadeController{
    
    public function api_dir(){
        return $this->limonade_api->get_api_dir();
    }
    
}