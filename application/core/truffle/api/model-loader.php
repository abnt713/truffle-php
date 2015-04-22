<?php

class ML{
    
    public static function model($model_name, $api_name){
        $uncamel = CaseParser::decamelize($model_name);
        $model_file_name = PathParser::underline_to_hiffen($uncamel);
        
        $model_file = './application/api/' . $api_name . '/models/' . $model_file_name . '.php';
        if(is_file($model_file)){
            require_once $model_file;
        }else{
            die('Cannot find Model "' . $model_name . '" defined at "' . $api_name . '" API');
        }
        
        $model = new $model_name();
        return $model;
    }
    
}