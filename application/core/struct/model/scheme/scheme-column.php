<?php

class SchemeColumn{
    
    private $column_name;
    private $constraints;
    
    public function __construct($column_name){
        $this->column_name = $column_name;
        $this->constraints = array();
    }
    
    public function set($constraint, $value){
        $this->constraints[$constraint] = $value;
        return $this;
    }
    
    public function get_column_name(){
        return $this->column_name;
    }
    
    public function get_constraints(){
        return $this->constraints;
    }
    
    public function get_sqlike_constraints(){
        return array(
            'type', 
            'length',
            'values',
            'default',
            'collation',
            'attribute',
            'null',
            'index',
            'auto-increment',
            'comment'
        );
    }
}