<?php

abstract class ModelScheme{
    
    private $columns;
    public function __construct(){
        $this->columns = array();
    }
    
    protected function create_column($column_name){
        $column = new SchemeColumn($column_name);
        $this->columns[] = $column;
        return $column;
    }
    
    abstract public function set_scheme();
    
}