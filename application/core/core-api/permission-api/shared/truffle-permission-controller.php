<?php

define('_PERMISSION_READ', 'read');
define('_PERMISSION_WRITE', 'write');
define('_PERMISSION_DELETE', 'delete');

SharedLibLoader::require_from_api('TruffleSessionController', 'session-api', _DEFAULT_API_DIR);

class TrufflePermissionController extends TruffleSessionController{
    
    protected function global_pre_hook(){
        SharedLibLoader::require_from_api('TrufflePermission', 'permission-api', _DEFAULT_API_DIR);
        SharedLibLoader::require_from_api('TruffleSession', 'session-api', _DEFAULT_API_DIR);
    }
    
    protected function get_pre_hook(){
        $is_logged = TruffleSession::is_logged_in();
        if(!$is_logged){
            return false;
        }
        
        return $this->check_permission(_PERMISSION_READ);
    }
    
    protected function post_pre_hook(){
        $is_logged = Session::is_logged_in();
        if(!$is_logged){
            return false;
        }
        
        return $this->check_permission(_PERMISSION_WRITE);
    }
    
    protected function put_pre_hook(){
        $is_logged = Session::is_logged_in();
        if(!$is_logged){
            return false;
        }
        
        return $this->check_permission(_PERMISSION_WRITE);
    }
    
    protected function delete_pre_hook(){
        $is_logged = Session::is_logged_in();
        if(!$is_logged){
            return false;
        }
        
        return $this->check_permission(_PERMISSION_DELETE);
    }
    
    private function check_permission($permission){
        return TrufflePermission::check($this->get_api_name(), get_class($this), Session::get_logged_id(), $permission);
    }
    
}