<?php

class TypeofFilter implements ValidationFilter{
    
    public function filter($data, $parameters = array()){
        $type = $parameters;
        switch($type){
            case 'integer':
                return is_numeric($data);
            break;
            case 'string':
                return is_string($data);
            break;
        }
    }
    
}