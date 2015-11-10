<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Reg_User_Profile extends CI_Controller {

    function __construct() {
        parent::__construct();

        if (!$this->session->userdata('USER_LOGGED_IN')) {
            redirect(site_url() . '/login/load_login');
        } else {
            $this->load->model('reg_user_profile/reg_user_profile_model');
            $this->load->model('reg_user_profile/reg_user_profile_service');
        }
    }

    /**
     * Function to add a registered user
     */
    function add_user() {
        $reg_user_profile_model   = new Reg_User_Profile_model();
        $reg_user_profile_service = new Reg_User_Profile_service();

        $avatar = $this->input->post('profile_pic', TRUE);
        $reg_user_profile_model->set_title($this->input->post('title', TRUE));
        $reg_user_profile_model->set_name($this->input->post('name', TRUE));

        if ($avatar == '') {
            $reg_user_profile_model->set_profile_pic('avatar.png');
        } else {
            $reg_user_profile_model->set_profile_pic($avatar);
        }

        $reg_user_profile_model->set_user_name($this->input->post('user_name', TRUE));
        $reg_user_profile_model->set_user_type($this->input->post('user_type', TRUE));
        $reg_user_profile_model->set_email($this->input->post('email', TRUE));
        $reg_user_profile_model->set_address($this->input->post('address', TRUE));
        $reg_user_profile_model->set_contact1($this->input->post('contact_no_1', TRUE));
        $reg_user_profile_model->set_contact2($this->input->post('contact_no_2', TRUE));
        $reg_user_profile_model->set_password(md5($this->input->post('password', TRUE)));
        $reg_user_profile_model->set_added_by($this->session->userdata('USER_ID'));
        $reg_user_profile_model->set_added_date(date("Y-m-d H:i:s"));
        $reg_user_profile_model->set_account_activation_code('code');
        $reg_user_profile_model->set_is_online('0');
        $reg_user_profile_model->set_is_published('1');
        $reg_user_profile_model->set_is_deleted('0');

        echo $reg_user_profile_service->add_user_profile($reg_user_profile_model);
    }

    /**
     * Function to delete the profile of a user
     */
    function delete_reg_user() {
        $reg_user_profile_service = new Reg_User_Profile_service();
        echo $reg_user_profile_service->delete_reg_user_profile(trim($this->input->post('user_id', TRUE)));
    }

    /**
     * Function to load the profile of a registered user
     */
    function load_profile_of_reg_user() {
        $reg_user_profile_model   = new Reg_User_Profile_model();
        $reg_user_profile_service = new Reg_User_Profile_service();

        $reg_user_profile_model->set_id($this->session->userdata('USER_ID'));
        $user_type    = $reg_user_profile_service->get_reg_user_by_id($reg_user_profile_model);
        $data['user'] = $user_type;



        echo $this->load->view('registered_user_profile/manage_registered_user_pro_view', $data);
    }

    /**
     * Function to load the registered user edit profile view
     */
    function load_reg_user_edit_profile() {
        $reg_user_profile_model   = new Reg_User_Profile_model();
        $reg_user_profile_service = new Reg_User_Profile_service();

        $reg_user_profile_model->set_id($this->session->userdata('USER_ID'));
        $data['user'] = $reg_user_profile_service->get_reg_user_by_id($reg_user_profile_model);

        echo $this->load->view('reg_user_profile/reg_user_profile_edit_view', $data);
    }

    /**
     * Function to update registered user details
     */
    function update_reg_user_profile() {
        $reg_user_profile_model   = new Reg_User_Profile_model();
        $reg_user_profile_service = new Reg_User_Profile_service();

        $data = array(
            'title'        => $this->input->post('title', TRUE),
            'name'         => $this->input->post('name', TRUE),
            'email'        => $this->input->post('email', TRUE),
            'address'      => $this->input->post('address', TRUE),
            'contact_no_1' => $this->input->post('contact_no_1', TRUE),
            'contact_no_2' => $this->input->post('contact_no_2', TRUE),
            'updated_date' => date("Y-m-d H:i:s")
        );
        $reg_user_profile_model->set_id($this->session->userdata('USER_ID'));
        $user = $reg_user_profile_service->get_reg_user_by_id($reg_user_profile_model);

        $sts = 0;
        if (isset($_POST['new_pwd'])) {
            if ($_POST['new_pwd'] != '') {
                if (strcmp($user->password, md5($this->input->post('current_pwd', TRUE))) == 0) {
                    $data['password'] = md5($this->input->post('new_pwd', TRUE));
                } else {
                    $sts = -1;
                }
            }
        }

        if ($sts == 0)
            if ($reg_user_profile_service->update_reg_user($user->user_name, $data) != 1)
                $sts = -1;

        if ($sts == 0)
            echo"SUCCESS";
        else
            echo"ERROR";
    }

    /**
     * update reg users profile password
     */
    function update_reg_user_profile_password() {
        $reg_user_profile_model   = new Reg_User_Profile_model();
        $reg_user_profile_service = new Reg_User_Profile_service();

        $reg_user_profile_model->set_id($this->session->userdata('USER_ID'));
        $user = $reg_user_profile_service->get_reg_user_by_id($reg_user_profile_model);

        $data = array();
        $sts  = 0;
        if (isset($_POST['new_pwd'])) {
            if ($_POST['new_pwd'] != '') {
                if (strcmp($user->password, md5($this->input->post('current_pwd', TRUE))) == 0) {
                    $data['password'] = md5($this->input->post('new_pwd', TRUE));
                } else {
                    $sts = -1;
                }
            }
        }
        if ($sts == 0)
            if ($reg_user_profile_service->update_reg_user($user->user_name, $data) != 1)
                $sts = -1;

        if ($sts == 0)
            echo"SUCCESS";
        else
            echo"ERROR";
    }

    /**
     * Function to update user password and avatar
     */
    function reset_password_and_avatar() {
        $reg_user_profile_model   = new Reg_User_Profile_model();
        $reg_user_profile_service = new Reg_User_Profile_service();

        $reg_user_profile_model->set_password($this->input->post('password', TRUE));
        $reg_user_profile_model->set_profile_pic($this->input->post('profile_pic', TRUE));
        $reg_user_profile_model->set_updated_by($this->session->userdata('USER_ID'));
        $reg_user_profile_model->set_updated_date(date("Y-m-d H:i:s"));

        echo $reg_user_profile_service->update_reg_user($reg_user_profile_model);
    }

    /**
     * This function is to upload user avatar
     */
    function upload_user_avatar() {

        $uploaddir  = './uploads/user_avatars/';
        $unique_tag = 'user_avatars';

        $filename = $unique_tag . time() . '-' . basename($_FILES['uploadfile']['name']); //this is the file name
        $file     = $uploaddir . $filename; // this is the full path of the uploaded file

        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
            echo $filename;
        } else {
            echo "error";
        }
    }

}
