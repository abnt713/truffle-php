<?php

class TruffleController extends LimonadeController{
    
    protected function load_model($model_name, $api_name = ''){
        $uncamel = CaseParser::decamelize($model_name);
        $dir_name = PathParser::underline_to_hiffen($uncamel);
        if($api_name == ''){
            $api_name = $this->limonade_api->get_api_name();
        }
        
        $model_dir = './application/api/' . $api_name . '/models/' . $dir_name . '/';
        $model_file = $model_dir . 'model.php';
        $scheme_file = $model_dir . 'scheme.php';
        if(is_file($model_file) && is_file($scheme_file)){
            require_once $model_file;
            require_once $scheme_file;
        }else{
            die('Cannot find Model "' . $model_name . '" defined at "' . $api_name . '" API');
        }
        
        $model = new $model_name();
        
        $scheme_class = $model_name . 'Scheme';
        $scheme = new $scheme_class();
        $model->set_scheme($scheme);
        
        return $model;
    }
    
}