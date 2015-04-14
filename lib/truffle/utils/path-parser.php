<?php

final class PathParser{
 
    public static function get_undashed($path){
        if(substr($path, -1, 1) == '/'){
            return substr($path, 0, strlen($path) - 1);
        }else{
            return $path;
        }
    }
    
    public static function get_hiffen($word){
        $decamelized = CaseParser::decamelize($word);
        return str_replace('_', '-', $decamelized);
    }
    
}