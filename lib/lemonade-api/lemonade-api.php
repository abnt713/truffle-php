<?php

class LemonadeAPI{

    private $prefix;
    private $assignments;
    private $api_name;
    private $require_on_demand;

    public function __construct($prefix, $api_name, $require_on_demand = true){
        $this->prefix = $prefix;
        $this->assignments = array();
        $this->api_name = $api_name;
        $this->require_on_demand = $require_on_demand;
    }

    public function append($route, $controller_class){
        if(!array_key_exists($route, $this->assignments)){
            $this->assignments[$route] = $controller_class;
        }else{
            die('Route already defined');
        }
    }

    public function serve(){
        $this->process_assignments();
    }

    private function process_assignments(){
        foreach($this->assignments as $raw_index => $raw_controller){
            $index = PathParser::get_undashed($this->prefix) . $raw_index;
            // Include controller
            if($this->require_on_demand){
                $include_prefix = 'api/' . $this->api_name . '/controllers';
                $path_index = PathParser::get_undashed($raw_index) . '/';
                $include_path = __DIR__ . '/../../' . $include_prefix . '/' . PathParser::get_hiffen($raw_controller) . '.php';
                require_once $include_path;                
            }
            $controller = new $raw_controller();

            dispatch_get($index, array($controller, '_get'));
            dispatch_post($index, array($controller, '_post'));
            dispatch_put($index, array($controller, '_put'));
            dispatch_delete($index, array($controller, '_delete'));
            dispatch_patch($index, array($controller, '_patch'));
        }
    }
}