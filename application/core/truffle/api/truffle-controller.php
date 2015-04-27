<?php

class TruffleController extends AssertController{

    public function api_dir(){
        return $this->limonade_api->get_api_dir();
    }

    public function success($halt = true){
        $this->set_status(1);
        $this->add_message('Success');

        echo $this->to_json();
        if($halt){
            exit();
        }
    }

}