<?php

define('_PASSWORD_GEN_COST', 10);

class PasswordGen{
    
    public static function generate_hashed_password($password, $salt, $cost = _PASSWORD_GEN_COST){
        $options = [
            'cost' => $cost,
            'salt' => $salt
        ];
        return password_hash($password, PASSWORD_BCRYPT, $options);
    }
    
    public static function generate_hash($size = 22, $source = MCRYPT_DEV_URANDOM){
        return mcrypt_create_iv($size, $source);
    }
    
}

