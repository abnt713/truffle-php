<?php

class MinlengthFilter implements ValidationFilter{
    
    public function filter($data, $parameters = array()){
        return strlen($data) >= $parameters;
    }
    
}