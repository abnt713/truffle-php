<?php

// Default outcomes (for your joy!)
abstract class ControllerOutcome{
    
    protected $data;
    
    public function __construct($data = ''){
        $this->data = $data;
    }
    
    abstract public function outcome($controller);
    
}

class SuccessOutcome extends ControllerOutcome{
    
    public function outcome($controller){
        $controller->set_status(1);
        $controller->add_message('Success');
        
        if(is_array($this->data)){
            $controller->set_contents($this->data);
        }
        echo json($controller->to_array());
        exit(1);
    }
    
}

class HaltOutcome extends ControllerOutcome{
    
    public function outcome($controller){
        $controller->set_status(0);
        $controller->add_message($this->data);
        echo json($controller->to_array());
        
        exit(1);
    }
    
}

class MessageOutcome extends ControllerOutcome{
    
    public function outcome($controller){
        $controller->set_status(0);
        $controller->add_message($this->data);
    }
    
}
