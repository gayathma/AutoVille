<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register_Users extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('register_users/register_users_model');
        $this->load->model('register_users/register_users_service');

        $this->load->model('vehicle_advertisments/vehicle_advertisments_model');
        $this->load->model('vehicle_advertisments/vehicle_advertisments_service');
    }

    /**
     * check email is already there
     */
    function check_email() {
        if ($this->register_users_service->check_email($_POST['email']))
            echo 1;
        else
            echo -1;
    }

    /**
     * check user name is already there
     */
    function check_username() {
        if ($this->register_users_service->check_username($_POST['username']))
            echo 1;
        else
            echo -1;
    }

    /**
     * load registration page
     */
    function load_registration() {

        $vehicle_advertisments_service = new Vehicle_advertisments_service();
        $data['latest_vehicles']       = $vehicle_advertisments_service->get_new_arrival(2);

        if ($this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/home/index');
        } else {
            $parials = array('content' => 'register_user/register', 'new_arrivals' => 'vehicle_adds/new_arrivals');
            $this->template->load('template/main_template', $parials, $data);
        }
    }

    /**
     * add new user
     * @return boolean true success ,false error
     */
    function add_new_user() {

        $register_users_model   = new Register_Users_model();
        $register_users_service = new Register_Users_service();


        $register_users_model->set_name($this->input->post('form_register_full_name', TRUE));
        $register_users_model->set_user_name($this->input->post('form_register_user_name', TRUE));
        $register_users_model->set_user_type('3');
        $register_users_model->set_email(trim($this->input->post('form_register_email', TRUE)));
        $register_users_model->set_address($this->input->post('form_register_address', TRUE));
        $register_users_model->set_contact1($this->input->post('form_register_contact', TRUE));
        //$register_users_model->set_contact2($this->input->post('contact_no_2', TRUE));
        $register_users_model->set_profile_pic('avatar.png');
        $register_users_model->set_password(md5($this->input->post('form_register_password', TRUE)));
        $register_users_model->set_is_online('0');
        $register_users_model->set_title(trim($this->input->post('title', TRUE)));

        $token = $this->generate_random_string(); //generate account activation token

        $register_users_model->set_account_activation_code($token);
        $register_users_model->set_is_published('0');
        $register_users_model->set_is_deleted('0');
        //$register_users_model->set_added_by($this->input->post('added_by', TRUE));
        //$register_users_model->set_added_date($this->input->post('added_date', TRUE));
        //$register_users_model->set_updated_date($this->input->post('updated_date', TRUE));
        //$register_users_model->set_updated_by($this->input->post('updated_by', TRUE));

        $register_users_model->set_account_activation_code($token);

        $register_users_service->add_new_user_registration($register_users_model);


        $email             = trim($this->input->post('form_register_email', TRUE)); //'ashanidiaz@gmail.com';  
        $email_subject     = "AutoVille Account Activation";
        $data['name']      = $this->input->post('form_register_full_name', TRUE);
        $data['user_name'] = $this->input->post('form_register_user_name', TRUE);
        $data['pasword']   = $this->input->post('form_register_password', TRUE);
        $data['link']      = site_url() . '/login/activate?email=' . $this->input->post('form_register_email', TRUE) . '&token=' . $token;
        $msg               = $this->load->view('template/mail_template/body', $data, TRUE);

        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: Autoville <info.autovillle@gmail.com>' . "\r\n";
        $headers .= 'Cc: info.autovillle@gmail.com' . "\r\n";

        if (mail($email, $email_subject, $msg, $headers)) {
            echo "1";
            $this->session->set_flashdata('info', 'Please go to your email account and continue the registration process');
        } else {
            echo "0";
        }

        return true;
    }

    /**
     * generate random string for url tocken
     * @param integer $length Input tocken length
     * @return string tocken
     */
    public function generate_random_string($length = 10) {
        $characters    = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $random_string = '';
        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $random_string;
    }

}
