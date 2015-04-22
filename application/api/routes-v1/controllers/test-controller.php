<?php

class TestController extends LimonadeController{
    
    public function get(){
        echo 'GET';
        $model = ML::model('TestModel', $this->get_api_name());
        
        echo '<pre>';
        var_dump($model->get_scheme());
        echo '</pre>';
    }
    
}