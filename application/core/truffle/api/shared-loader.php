<?php

class SharedLibLoader{
    
    public static function require_from_api($lib_class, $api_name, $api_dir = ''){
        $uncamel = CaseParser::decamelize($lib_class);
        $lib_file_name = PathParser::underline_to_hiffen($uncamel);
        
        if($api_dir == ''){
            $api_dir = './application/api/' . $api_name;
        }else{
            $api_dir .= '/' . $api_name;
        }
        $lib_file = $api_dir . '/shared/' . $lib_file_name . '.php';
        if(is_file($lib_file)){
            require_once $lib_file;
            return true;
        }
        
        return false;
    }
    
}