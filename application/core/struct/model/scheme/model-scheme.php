<?php

abstract class ModelScheme{
    
    private $table_name;
    private $columns;
    
    private $primary_keys;
    private $unique_keys;
    private $keys;
    
    private $engine;
    private $default_charset;
    private $ai_value;
    
    public function __construct($table_name){
        $this->table_name = $table_name;
        $this->columns = array();
        $this->primary_keys = array();
        $this->unique_keys = array();
        $this->keys = array();
        $this->set_scheme();
    }
    
    public function set_table_name($table_name){
        $this->table_name = $table_name;
    }
    
    public function get_table_name(){
        return $this->table_name;
    }
    
    public function set_primary_keys($pkeys){
        $this->primary_keys = $pkeys;
    }
    
    public function set_unique_keys($ukeys){
        $this->unique_keys = $ukeys;
    }
    
    public function set_keys($indexes){
        $this->keys = $indexes;
    }
    
    public function set_engine($engine){
        $this->engine = $engine;
    }
    
    public function set_auto_increment($auto_increment){
        $this->ai_value = $auto_increment;
    }
    
    public function set_default_charset($charset){
        $this->default_charset = $charset;
    }
    
    protected function create_column($column_name){
        $column = new SchemeColumn($column_name);
        $this->columns[] = $column;
        return $column;
    }
    
    abstract protected function set_scheme();
    
    public function get_scheme(){
        $ret_val = array(
            'table_name' => $this->table_name,
            'columns' => array()
        );
        
        foreach($this->columns as $column){
            $ret_val['columns'][$column->get_column_name()] = $column->get_constraints();
        }
        
        $ret_val['pkeys'] = $this->primary_keys;
        $ret_val['ukeys'] = $this->unique_keys;
        $ret_val['keys'] = $this->keys;
        
        $ret_val['engine'] = $this->engine;
        $ret_val['charset'] = $this->default_charset;
        $ret_val['auto_increment'] = $this->ai_value;
        
        return $ret_val;
    }
    
}