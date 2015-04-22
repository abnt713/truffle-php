<?php

interface RawValidator{
    
    public function validate_one($data, $conditions);
    public function validate_many($data_set, $conditions);
    
}