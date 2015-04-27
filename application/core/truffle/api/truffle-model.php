<?php

abstract class TruffleModel extends RawModel{
    
    private $scheme;
    
    public function __construct($table_name){
        parent::__construct($table_name);
        $this->scheme = new ModelScheme();
        $this->set_scheme($this->scheme);
    }
    
    public function insert_one_pre_hook(){
        /* Parâmetro: array com os dados das colunas => valor */
        return $this->validate_data();
    }
    
    public function insert_many_pre_hook(){
        return $this->validate_multiple_data();
    }
    
    public function update_one_pre_hook(){
        return $this->validate_data();
    }
    
    public function update_many_pre_hook(){
        return $this->validate_data();
    }
    
    private function validate_data(){
        $data = $this->get_operation_value('data');
        return $this->validate_single_data($data);
    }
    
    private function validate_multiple_data(){
        $data = $this->get_operation_value('data');
        $operation = true;
        foreach($data as $single_data){
            $operation = $operation && $this->validate_single_data($data);
        }
        return $operation;
    }
    
    private function validate_single_data($data){
        $constraints = $this->scheme->get_scheme();
        
        $validator = new FilterValidator(TruffleApp::default_filter_paths());
        return $validator->validate_many($data, $constraints);
    }
    
    protected function set_scheme($scheme){
        return;
    }
    
}