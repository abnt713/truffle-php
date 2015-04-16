<?php

class TruffleApi extends LemonadeApi{

    private $require_from_simple_dir;

    public function __construct($prefix, $api_name, $require_from_simple_dir = true){
        parent::__construct($prefix, $api_name);
        $this->require_from_simple_dir = $require_from_simple_dir;
    }

    public function append($route, $controller_class, $require_path = ''){
        if($this->require_from_simple_dir || $require_path != ''){
            $include_path = './api/' . $this->get_api_name() . '/controllers';
            $file_name = PathParser::get_hiffen($controller_class) . '.php';
            
            if($this->require_from_simple_dir){
                require_once $include_path . '/' . $file_name;
            }else{
                $custom_include_path = $include_path . $require_path . $file_name;
                if(is_file($custom_include_path)){
                    require_once $custom_include_path;
                }else{
                    die('Incorrect route for API "' . __CLASS__ . '" at route "' . $route . '" - Controller file not found');
                }
            }
        }
        
        parent::append($route, $controller_class);
    }

}