<?php

class MaxlengthFilter implements ValidationFilter{
    
    public function filter($data, $parameters = array()){
        return strlen($data) < $parameters;
    }
    
}