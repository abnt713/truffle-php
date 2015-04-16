<?php

define('MODEL_PRIMARY_KEY_INDEX', 'id');
define('MODEL_CRITERIA_INDEX', 'criteria');
define('MODEL_DATA_INDEX', 'data');

abstract class RawModel{

    private $table_name;
    private $operation;

    public function __construct($table_name){
        $this->table_name = $table_name;
        $this->operation = null;
    }

    private function begin_operation(){
        $this->operation = array();
    }
    
    protected function set_operation_value($key, $value){
        $this->operation[$key] = $value;
    }
    
    protected function unset_operation_value($key){
        unset($this->operation[$key]);
    }
    
    protected function get_operation_value($key){
        return (isset($this->operation[$key]) ? $this->operation[$key] : null);
    }

    private function end_operation(){
        $this->operation = null;
    }

    public function begin_transaction(){
        ORM::get_db()->beginTransaction();
    }

    public function commit(){
        ORM::get_db()->commit();
    }

    public function roll_back(){
        ORM::get_db()->rollBack();
    }

    public function get_one($params){
        $this->_method('get_one', $params);
    }
    
    public function get_many($params){
        $this->_method('get_many', $params);
    }
    
    public function insert($params){
        $this->_method('insert', $params);
    }
    
    public function update_one($params){
        $this->_method('update_one', $params);
    }
    
    public function update_many($params){
        $this->_method('update_many', $params);
    }
    
    public function delete_one($params){
        $this->_method('delete_one', $params);
    }
    
    public function delete_many($params){
        $this->_method('delete_many', $params);
    }
    
    private function _method($callable_method_name, $params){
        $this->begin_operation();
        $this->set_operation_value('params', $params);
        
        if(!$this->inspect_method_name($callable_method_name)){
            die('Undefined method call ' . $callable_method_name . ' at ' . __CLASS__);
        }
        
        $_callable_method_name = '_' . $callable_method_name;
        $this->call_hook($callable_method_name, 'pre_hook');
        $this->$_callable_method_name();
        $this->call_hook($callable_method_name, 'pos_hook');
        
        $this->end_operation();
    }

    private function call_hook($method_name, $hook_time){
        if($this->inspect_method_name($method_name)){
            $hook_name = $method_name . '_' . $hook_time;
            if(method_exists($this, $hook_name)){
                $this->$hook_name();
            }
        }
    }

    private function inspect_method_name($method_name){
        $available_methods = array(
            'get_one', 'get_many', 'insert', 'update_one', 'update_many', 'delete_one', 'delete_many'
        );

        return in_array($method_name, $available_methods);
    }

    /* As operações abaixo assumem que os dados já foram validados */
    private function _get_one(){
        $params = $this->get_operation_value('params');
        $id = $params[MODEL_PRIMARY_KEY_INDEX];
        $table = ORM::for_table($this->table_name);
        if(isset($params[MODEL_CRITERIA_INDEX])){
            foreach($params[MODEL_CRITERIA_INDEX] as $function => $args){
                $table->$function($args[0], $args[1]);
            }
        }
        if(!is_null($id)){
            return $table->find_one($id);
        }else{
            return $table->find_one();
        }
    }

    private function _get_many(){
        $params = $this->get_operation_value('params');
        $criterias = isset($params['MODEL_CRITERIA_INDEX']) ? $params['MODEL_CRITERIA_INDEX'] : array();
        
        $table = ORM::for_table($this->table_name);
        if(count($criterias) > 0){
            foreach($criterias as $function => $args){
                $table->$function($args[0], $args[1]);
            }
        }
        return $table->find_many();
    }

    private function _insert(){
        $params = $this->get_operation_value('params');
        $data = $params[MODEL_DATA_INDEX];
        $row = ORM::for_table($this->table_name)->create();
        foreach($data as $column => $value){
            $row->$column = $value;
        }
        $row->save();
    }

    private function _update_one(){
        $params = $this->get_operation_value('params');
        $id = $params[MODEL_PRIMARY_KEY_INDEX];
        $data = $params[MODEL_DATA_INDEX];
        $row = ORM::for_table($this->table_name)->find_one($id);
        foreach($data as $column => $value){
            $row->$column = $value;
        }
        $row->save();
    }

    private function _update_many(){
        $params = $this->get_operation_value('params');
        $data = $params[MODEL_DATA_INDEX];
        $result_set = ORM::for_table($this->table_name)->find_result_set();
        foreach($data as $column => $value){
            $result_set->set($column, $value);
        }
        $result_set->save();
    }

    private function _delete_one(){
        $params = $this->get_operation_value('params');
        $id = $params[MODEL_PRIMARY_KEY_INDEX];
        ORM::for_table($this->table_name)->find_one($id)->delete();
    }

    private function _delete_many($params){
        $params = $this->get_operation_value('params');
        $criterias = $params[MODEL_CRITERIA_INDEX];
        $table = ORM::for_table($this->table_name);
        if(count($params) > 0){
            foreach($criterias as $function => $args){
                $table->$function($args[0], $args[1]);
            }
        }
        $table->find_result_set()->delete_many();
    }
}