<?php

class SchemeColumn{
    
    private $column_name;
    private $constraints;
    
    public function __construct($column_name){
        $this->column_name = $column_name;
        $this->constraints = array();
    }
    
    public function set($constraint, $value){
        $this->constraints[$constraint] => $value;
    }
}