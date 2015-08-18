<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('users/user_model');
        $this->load->model('users/user_service');
        $this->load->model('access_controll/access_controll_service');
    }

    function load_login() {
        if ($this->session->userdata('USER_LOGGED_IN')) {

            redirect(site_url() . '/dashboard');
            //$this->template->load('template/main_template');
        } else {
            $this->template->load('template/login');
        }
    }

    //Login details checking function 
    function authenticate_user() {

        $user_model = new User_model();
        $user_service = new User_service();

        $user_model->set_user_name($this->input->post('login_username', TRUE));
        $user_model->set_password(md5($this->input->post('login_password', TRUE)));

        $result_user = $user_service->authenticate_user_with_password($user_model);

        if (count($result_user) == 0) {
            $logged_user_result = false;
        } else {
            $logged_user_result = true;
        }

        if ($logged_user_result) {

            $this->session->set_userdata('USER_ID', $result_user->id);
            $this->session->set_userdata('USER_FULLNAME', $result_user->name);
            $this->session->set_userdata('USER_NAME', $result_user->user_name);
            $this->session->set_userdata('USER_TYPE', $result_user->user_type);
            $this->session->set_userdata('USER_EMAIL', $result_user->email);
            $this->session->set_userdata('USER_PROFILE_PIC', $result_user->profile_pic);
            $this->session->set_userdata('USER_ONLINE', 'Y');
            $this->session->set_userdata('USER_LOGGED_IN', 'TRUE');

            $user_model->set_id($this->session->userdata('USER_ID'));
            $user_model->set_is_online('1');
            $user_service->update_user_online_status($user_model);

            echo 1;
        } else {
            echo 0;
        }
    }

    function logout() {

        $user_model = new User_model();
        $user_service = new User_service();

        $user_model->set_is_online('0');
        $user_model->set_id($this->session->userdata('USER_ID'));
        $user_service->update_user_online_status($user_model);

        $this->session->set_userdata('USER_ONLINE', 'N');
        $this->session->set_userdata('USER_LOGGED_IN', 'FALSE');

        $this->session->sess_destroy();
        redirect(site_url() . '/login/load_login');
    }
    
    function reset_password(){
        
         $user_service = new User_service();
         
         $admin_list=$user_service->get_admin_details();
         $email=$this->input->post('login_username', TRUE);
    }

}
