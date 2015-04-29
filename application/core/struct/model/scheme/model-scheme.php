<?php

class ModelScheme{
    
    private $columns;
    
    public function __construct(){
        $this->columns = array();
    }
    
    public function create_column($column_name){
        $column = new SchemeColumn($column_name);
        $this->columns[] = $column;
        return $column;
    }
    
    public function get_scheme(){
        if(empty($this->columns)){
            return null;
        }
        
        $ret_val = array();
        foreach($this->columns as $column){
            $ret_val[$column->get_column_name()] = $column->get_constraints();
        }        
        return $ret_val;
    }
    
}