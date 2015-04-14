<?php

class LemonadeAPI{

    private $prefix;
    private $assignments;
    private $api_name;
    private $mimic_route;

    public function __construct($prefix, $api_name, $mimic_route = true){
        $this->prefix = $prefix;
        $this->assignments = array();
        $this->api_name = $api_name;
        $this->mimic_route = $mimic_route;
    }

    public function append($route, $controller_class){
        if(!array_key_exists($route, $this->assignments)){
            $this->assignments[$route] = $controller_class;
        }else{
            $this->throw_error('Route already defined');
        }
    }

    public function throw_error($error, $halt = true){
        die($error);
    }

    public function serve(){
        $this->process_assignments();
    }

    private function process_assignments(){
        foreach($this->assignments as $raw_index => $raw_controller){

            $index = $this->get_undashed($this->prefix) . $raw_index;
            $include_prefix = 'api/' . $this->api_name . '/controllers';
            // Include controller
            if($this->mimic_route){
                $include_path = realpath(__DIR__ . '/../../' . $include_prefix . $raw_index . $this->get_hiffen($raw_controller) . '.php');
                require_once $include_path;
            }else{
                require_once $include_prefix . '/' . $this->get_hiffen($raw_controller);
            }
            $controller = new $raw_controller();

            dispatch_get($index, array($controller, '_get'));
            dispatch_post($index, array($controller, '_post'));
            dispatch_put($index, array($controller, '_put'));
            dispatch_delete($index, array($controller, '_delete'));
            dispatch_patch($index, array($controller, '_patch'));
        }
    }

    private function get_undashed($path){
        if(substr($path, -1, 1) == '/'){
            return substr($path, 0, strlen($path) - 1);
        }else{
            return $path;
        }
    }

    private function get_hiffen($word){
        $decamelized = CaseParser::decamelize($word);
        return str_replace('_', '-', $decamelized);
    }

    

}