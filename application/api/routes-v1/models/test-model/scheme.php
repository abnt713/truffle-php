<?php

class TestModelScheme extends ModelScheme{
    
    public function set_scheme(){
        $name_column = $this->create_column('name');
        $name_column->set('typeof', 'string');
    }
    
}