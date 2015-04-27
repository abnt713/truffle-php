<?php

define('JSON_CTRL_STATUS', 'status');
define('JSON_CTRL_MESSAGES', 'messages');
define('JSON_CTRL_CONTENTS', 'contents');

class JsonController extends LimonadeController{
    
    private $json;
    
    public function __construct(){
        $this->json = array();
        $this->json[JSON_CTRL_STATUS] = 1;
        $this->json[JSON_CTRL_MESSAGES] = array();
        $this->json[JSON_CTRL_CONTENTS] = array();
    }
    
    public function set_status($status){
        $this->json[JSON_CTRL_STATUS] = $status;
    }
    
    public function get_status(){
        return $this->json[JSON_CTRL_STATUS];
    }
    
    public function add_message($message){
        $this->json[JSON_CTRL_MESSAGES][] = $message;
    }
    
    public function set_messages($messages){
        $this->json[JSON_CTRL_MESSAGES] = $messages;
    }
    
    public function get_messages(){
        return $this->json[JSON_CTRL_MESSAGES];
    }
    
    public function add_content($index, $content){
        $this->json[JSON_CTRL_CONTENTS][$index] = $content;
    }
    
    public function set_contents($contents){
        $this->json[JSON_CTRL_CONTENTS] = $contents;
    }
    
    public function get_contents(){
        return $this->json[JSON_CTRL_CONTENTS];
    }
    
    public function to_json(){
        return json_encode($this->json);
    }
}