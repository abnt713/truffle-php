<?php

abstract class TruffleModel extends RawModel{
    
    public function insert_pre_hook(){
        /* Parâmetro: array com os dados das colunas => valor */
        return $this->validate_data();
    }
    
    public function update_one_pre_hook(){
        return $this->validate_data();
    }
    
    public function update_many_pre_hook(){
        return $this->validate_data();
    }
    
    private function validate_data(){
        $data = $this->get_operation_value('data');
        $scheme = $this->scheme->get_scheme();
        $constraints = $scheme['constraints'];
        
        $validator = new FilterValidator(TruffleApp::default_filter_paths());
        return $validator->validate_many($data, $constraints);
    }
    
}