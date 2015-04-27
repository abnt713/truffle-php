<?php

class TruffleApi extends LimonadeApi{

    private $api_dir;

    public function get_api_dir(){
        return $this->api_dir;
    }

    public function set_api_dir($api_dir){
        $this->api_dir = $api_dir;
    }

    public function __construct($prefix, $api_name){
        parent::__construct($prefix, $api_name);
    }

    public function append($route, $controller_class){
        $include_path = $this->get_api_dir() . '/controllers';
        $file_name = PathParser::underline_to_hiffen($controller_class) . '.php';

        require_once $include_path . '/' . $file_name;
        parent::append($route, $controller_class);
    }

}