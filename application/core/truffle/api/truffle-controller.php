<?php

class TruffleController extends AssertController{

    public function api_dir(){
        return $this->limonade_api->get_api_dir();
    }

    public function success($halt = true){
        $this->reach_outcome(new SuccessOutcome());
        if($halt){
            exit();
        }
    }

}