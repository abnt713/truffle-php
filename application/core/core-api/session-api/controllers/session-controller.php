<?php

class SessionController extends TruffleController {

    // Check if user is logged in
    public function get() {
        $is_logged = TruffleSession::is_logged_in();
        $this->assert_expression($is_logged, new HaltOutcome('User is not logged in'));
        $this->success();
    }

    public function post() {
        $is_logged = TruffleSession::is_logged_in();
        $this->assert_expression(!$is_logged, new HaltOutcome('Already logged in - Destroy current session before creating another'));

        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');

        $salt = $this->find_user_hash($username);
        SharedLibLoader::require_from_api('PasswordGen', 'account-api', _DEFAULT_API_DIR);
        $generated_password = PasswordGen::generate_hashed_password($password, $salt);
        $matched = $this->find_user($username, $generated_password);
        $user = $matched;
        
        $token = $this->open_session($user->id);
        $this->add_content('token', $token);
        $this->success();
    }

    private function find_user_hash($username){
        $u_model = ML::model('AccountModel', 'account-api', _DEFAULT_API_DIR);
        $matched = $u_model->get_one(array('where' => array('username' => $username)));
        return $matched->hash;
        
    }
    
    private function find_user($username, $password) {
        $u_model = ML::model('AccountModel', 'account-api', _DEFAULT_API_DIR);
        $matched = $u_model->get_one(array(
            'where' => array('username' => $username, 'password' => $password)
        ));
        $this->assert_expression($matched, new HaltOutcome('Not user was found for the given parameters'));
        return $matched;
    }

    private function open_session($user_id) {
        $session_model = ML::model('SessionModel', $this->get_api_name(), _DEFAULT_API_DIR);

        $token = $this->create_token($user_id);
        $current_date = new DateTime();
        $data = array(
            'user_id' => $user_id,
            'token' => $token,
            'created' => $current_date->format('Y-m-d H:i:s'),
            'valid' => $current_date->add(new DateInterval('PT' . SESSION_TIME_IN_MINUTES . 'M'))->format('Y-m-d H:i:s')
        );
        $this->assert_expression($session_model->insert_one($data), new HaltOutcome('Could not create token'));
        return $token;
    }

    private function create_token($user_id) {
        $random_password = uniqid($user_id, true) . $user_id;
        return sha1($random_password);
    }

}
