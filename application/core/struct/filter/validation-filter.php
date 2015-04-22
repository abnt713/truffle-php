<?php

interface ValidationFilter{
    
    public function filter($data, $parameters = array());
    
}