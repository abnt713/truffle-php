<?php

class DataMapper{
    
    private $dictionary;
    
    public function set_dictionary($dictionary){
        $this->dictionary = $dictionary;
    }
    
    public function map($dataset){
        $mapped_dataset = array();
        
        foreach($dataset as $index => $value){
            $associated_column = $this->dictionary[$index];
            $mapped_dataset[$associated_column] = $value;
        }
        
        return $mapped_dataset;
    }
    
}