<?php

define('_SESSION_TOKEN_HEADER', 'auth-token');

class TruffleSession{
    
    public static function is_logged_in(){
        $tokens = self::get_matched_tokens();
        if(count($tokens) <= 0 || !$tokens){
            return false;
        }
        $token = $tokens[0];
        
        $current_time = new DateTime();
        $current_timestamp = $current_time->getTimestamp();
        $token_timestamp = strtotime($token->valid);
        
        if($current_timestamp > $token_timestamp){
            return false;
        }
        
        return true;
    }
    
    public static function get_logged_id(){
        if(!self::is_logged_in()){
            return false;
        }
        
        $tokens = self::get_matched_tokens();
        
        $token = $tokens[0];
        return $token->user_id;
    }
    
    private static function get_matched_tokens(){
        $model = ML::model('SessionModel', 'session-api', _DEFAULT_API_DIR);
        $headers = getallheaders();
        $auth = isset($headers[_SESSION_TOKEN_HEADER]) ? $headers[_SESSION_TOKEN_HEADER] : null;
        if(is_null($auth)){
            return false;
        }
        
        $tokens = $model->get_many(array(
            'where' => array('token' => $auth)
        ));
        
        return $tokens;
    }
    
}