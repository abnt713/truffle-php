<?php

class TruffleSessionController extends TruffleController{
    
    protected function get_pre_hook(){
        return Session::is_logged_in();
    }
    
    protected function post_pre_hook(){
        return Session::is_logged_in();
    }
    
    protected function put_pre_hook(){
        return Session::is_logged_in();
    }
    
    protected function delete_pre_hook(){
        return Session::is_logged_in();
    }
}