<?php

SharedLibLoader::require_from_api('TrufflePermissionController', 'permission-api', _DEFAULT_API_DIR);

class AccountController extends TrufflePermissionController {

    public function put_pre_hook() {
        return true;
    }

    public function get(){
        $user_id = isset($GLOBALS['uid']) ? $GLOBALS['uid'] : null;
        $this->assert_expression(!is_null($user_id), new HaltOutcome('User is not logged in'));
        
        $model = ML::model('AccountModel', $this->get_api_name());
        $account = $model->get_one($user_id);
        
        $this->assert_expression($account, new HaltOutcome('Account does not exist'));
        $this->add_content('account', $account->as_array());
        $this->success();
    }
    
    // Create new account
    public function put() {
        // We need name, e-mail, username and password
        $_PUT = $GLOBALS['_PUT'];
        
        $this->assert_expression(count($_PUT) > 0, new HaltOutcome('Could not find request data'));
        
        $name = $_PUT['name'];
        $email = $_PUT['email'];
        $username = $_PUT['username'];
        $password = $_PUT['password'];
        
        SharedLibLoader::require_from_api('PasswordGen', $this->get_api_name(), _DEFAULT_API_DIR);
        $generated_hash = mcrypt_create_iv(22, MCRYPT_DEV_URANDOM);
        $generated_password = PasswordGen::generate_hashed_password($password, $generated_hash);
        $model = ML::model('AccountModel', $this->get_api_name(), _DEFAULT_API_DIR);

        $mapped = [
            'name' => $name,
            'email' => $email,
            'username' => $username,
            'password' => $generated_password,
            'hash' => $generated_hash,
            'created' => now()
        ];

        $this->assert_expression($model->insert_one($mapped), new HaltOutcome('Could not create user account'));
        $this->success();
    }

    // Update account
    public function post() {
        
    }

    // Delete account
    public function delete() {
        
    }

}
