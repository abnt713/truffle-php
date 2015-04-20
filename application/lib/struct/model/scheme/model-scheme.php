<?php

abstract class ModelScheme{
    
    private $table_name;
    private $columns;
    public function __construct(){
        $this->table_name = '';
        $this->columns = array();
        $this->set_scheme();
    }
    
    public function set_table_name($table_name){
        $this->table_name = $table_name;
    }
    
    public function get_table_name(){
        return $this->table_name;
    }
    
    protected function create_column($column_name){
        $column = new SchemeColumn($column_name);
        $this->columns[] = $column;
        return $column;
    }
    
    abstract public function set_scheme();
    
    public function get_scheme(){
        $ret_val = array(
            'table_name' => $this->table_name,
            'constraints' => array()
        );
        
        foreach($this->columns as $column){
            $ret_val['constraints'][$column->get_column_name()] = $column->get_constraints();
        }
        
        return $ret_val;
    }
    
}