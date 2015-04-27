<?php

class AssertController extends JsonController{
    
    protected function assert_expression($boolean_expression, $outcome){
        if(!$boolean_expression){
            $outcome->outcome($this);
        }
    }
    
    protected function reach_outcome($outcome){
        $outcome->outcome($this);
    }
    
}