<?php

class RequiredFilter implements ValidationFilter{
    
    public function filter($data, $parameters = array()){
        if($parameters){
            return !is_null($data) && !empty($data);
        }else{
            return true;
        }
    }
    
}