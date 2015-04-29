<?php

class AccountModel extends TruffleModel{
 
    public function __construct(){
        parent::__construct('truffle_accounts');
    }
    
    public function set_scheme($scheme){
        $name_column = $scheme->create_column('name');
        $name_column
            ->set('type', 'string')
            ->set('maxlength', 100)
            ->set('minlength', 4)
            ->set('required', true);
        
        $email_column = $scheme->create_column('email');
        $email_column
            ->set('type', 'string')
            ->set('maxlength', 200)
            ->set('minlength', 10)
            ->set('required', true);
        
        $username_column = $scheme->create_column('username');
        $username_column
            ->set('type', 'string')
            ->set('maxlength', 22)
            ->set('minlength', 8)
            ->set('required', true);
        
        $password_column = $scheme->create_column('password');
        $password_column
            ->set('type', 'string')
            ->set('maxlength', 72)
            ->set('required', true);
    }
    
}