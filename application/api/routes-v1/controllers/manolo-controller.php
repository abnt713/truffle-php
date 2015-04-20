<?php

class ManoloController extends TruffleController{
    
    public function get(){
        $model = $this->load_model('TestModel');
        $model->begin_transaction();
        $new_test = array(
            'name' => 2
        );
        
        var_dump($model->insert($new_test));
        
    }
}