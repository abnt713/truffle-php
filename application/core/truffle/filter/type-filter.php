<?php

class TypeFilter implements ValidationFilter{
    
    public function filter($data, $parameters = array()){
        $type = $parameters;
        switch($type){
            case 'integer':
            if(is_numeric($data)){
                if(intval($data) != 0){
                    return true;
                }else if($data == '0'){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
            break;
            case 'string':
                return is_string($data) && !is_numeric($data);
            break;
        }
    }
    
}