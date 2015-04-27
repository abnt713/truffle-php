<?php

class FilterValidator implements RawValidator{

    private $filter_paths;
    private $required_filters;

    public function __construct($paths){
        $this->filter_paths = $paths;
        $this->required_filters = array();
    }

    public function add_filter_path($filter_path){
        $this->filter_paths[] = $filter_path;
    }

    public function validate_one($data, $filters){
        $result = true;
        foreach($filters as $filter => $value){
            if(!in_array($filter, $this->required_filters)){
                if(!$this->require_filter($filter)){
                    continue;
                }
            }
            $className = CaseParser::camelize($filter) . 'Filter';
            $filter = new $className();
            $result = $result && $filter->filter($data, $value);
        }

        return $result;
    }

    public function validate_many($dataset, $filters){
        $result = true;
        foreach($dataset as $index => $data){
            $filter = isset($filters[$index]) ? $filters[$index] : null;
            if(!is_null($filter)){
                $result = $result && $this->validate_one($data, $filter);
            }
        }
        return $result;
    }

    private function require_filter($filter){
        foreach($this->filter_paths as $path){
            $require_file = $path . '/' . PathParser::underline_to_hiffen($filter) . '-filter.php';
            if(is_file($require_file)){
                require_once $require_file;
                $this->required_filters[] = $filter;
                return true;
            }
        }
        return false;
    }

}