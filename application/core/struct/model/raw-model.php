<?php

define('MODEL_PRIMARY_KEY_INDEX', 'id');
define('MODEL_CRITERIA_INDEX', 'criteria');
define('MODEL_DATA_INDEX', 'data');

abstract class RawModel extends ModelScheme{

    private $operation;

    public function __construct($table_name){
        parent::__construct($table_name);
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

    public function get_one($id){
        $this->begin_operation();
        $this->set_operation_value('id', $id);
        $ret_val = $this->_method('get_one');
        $this->end_operation();
        return $ret_val;
    }

    public function get_many($criteria = array()){
        $this->begin_operation();
        $this->set_operation_value('criteria', $criteria);
        $ret_val = $this->_method('get_many');
        $this->end_operation();
        return $ret_val;
    }

    public function insert($data){
        $this->begin_operation();
        $this->set_operation_value('data', $data);
        $ret_val = $this->_method('insert');
        $this->end_operation();
        return $ret_val;
    }

    public function update_one($id, $data){
        $this->begin_operation();
        $this->set_operation_value('id', $id);
        $this->set_operation_value('data', $data);
        $ret_val = $this->_method('update');
        $this->end_operation();
        return $ret_val;
    }

    public function update_many($data, $criteria = array()){
        $this->begin_operation();
        $this->set_operation_value('data', $data);
        $this->set_operation_value('criteria', $criteria);
        $ret_val = $this->_method('update_many');
        $this->end_operation();
        return $ret_val;
    }

    public function delete_one($id){
        $this->begin_operation();
        $this->set_operation_value('id', $data);
        $ret_val = $this->_method('delete_one');
        $this->end_operation();
        return $ret_val;
    }

    public function delete_many($criteria = array()){
        $this->begin_operation();
        $this->set_operation_value('criteria', $criteria);
        $ret_val = $this->_method('delete_many');
        $this->end_operation();
        return $ret_val;
    }

    private function _method($callable_method_name){
        if(!$this->inspect_method_name($callable_method_name)){
            die('Undefined method call ' . $callable_method_name . ' at ' . __CLASS__);
        }

        $_callable_method_name = '_' . $callable_method_name;
        if($this->call_hook($callable_method_name, 'pre_hook')){
            $ret_val = $this->$_callable_method_name();
        }else{
            $ret_val = false;
        }
        $this->call_hook($callable_method_name, 'pos_hook');

        $this->end_operation();
        return $ret_val;
    }

    private function call_hook($method_name, $hook_time){
        $ret_val = true;
        if($this->inspect_method_name($method_name)){
            $hook_name = $method_name . '_' . $hook_time;
            if(method_exists($this, $hook_name)){
                $ret_val = $this->$hook_name();
            }
        }

        return $ret_val;
    }

    private function inspect_method_name($method_name){
        $available_methods = array(
            'get_one', 'get_many', 'insert', 'update_one', 'update_many', 'delete_one', 'delete_many'
        );

        return in_array($method_name, $available_methods);
    }

    /* As operações abaixo assumem que os dados já foram validados */
    private function _get_one(){
        $id = $this->get_operation_value('id');
        $table = ORM::for_table($this->table_name);
        
        return $table->find_one($id);
    }

    private function _get_many(){
        $criteria = $this->get_operation_value('criteria');
        $table = ORM::for_table($this->table_name);
        if(count($criteria) > 0){
            foreach($criteria as $function => $args){
                $table->$function($args[0], $args[1]);
            }
        }
        return $table->find_many();
    }

    private function _insert(){
        $data = $this->get_operation_value('data');
        $row = ORM::for_table($this->table_name)->create();
        foreach($data as $column => $value){
            $row->$column = $value;
        }
        return $row->save();
    }

    private function _update_one(){
        $id = $this->get_operation_value('id');
        $data = $this->get_operation_value('data');
        $row = ORM::for_table($this->table_name)->find_one($id);
        foreach($data as $column => $value){
            $row->$column = $value;
        }
        return $row->save();
    }

    private function _update_many(){
        $data = $this->get_operation_value('data');
        $criteria = $this->get_operation_value('criteria');

        $table = ORM::for_table($this->table_name);
        if(count($criteria) > 0){
            foreach($criteria as $function => $args){
                $table->$function($args[0], $args[1]);
            }
        }

        $result_set = $table->find_result_set();
        foreach($data as $column => $value){
            $result_set->set($column, $value);
        }

        return $result_set->save();
    }

    private function _delete_one(){
        $id = $this->get_operation_value('id');
        return ORM::for_table($this->table_name)->find_one($id)->delete();
    }

    private function _delete_many($params){
        $criteria = $this->get_operation_value('criteria');
        $table = ORM::for_table($this->table_name);
        if(count($params) > 0){
            foreach($criteria as $function => $args){
                $table->$function($args[0], $args[1]);
            }
        }
        return $table->find_result_set()->delete_many();
    }

}