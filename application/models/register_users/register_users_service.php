<?php

class Register_Users_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('register_users/register_users_model');
    }

    /**
     * check email is already there
     * @param string $email Input user email
     * @return boolean
     */
    function check_email($email) {
        $this->db->from('user');
        $this->db->where('email', $email);
        $query = $this->db->get();
        $res   = $query->row();
        if (empty($res))
            return true;
        return false;
    }

    /**
     * check username is already there
     * @param string $username Input username
     * @return boolean
     */
    function check_username($username) {
        $this->db->from('user');
        $this->db->where('user_name', $username);
        $query = $this->db->get();
        $res   = $query->row();
        if (empty($res))
            return true;
        return false;
    }

    /**
     * update user
     * @param object $register_users_model Input model
     * @return boolean
     */
    function update_user($register_users_model) {

        $data = array(//'id'=>$register_users_model->get_id(),
            'title'                    => $register_users_model->get_title(),
            'name'                     => $register_users_model->get_name(),
            'user_name'                => $register_users_model->get_user_name(),
            'email'                    => $register_users_model->get_email(),
            'address'                  => $register_users_model->get_address(),
            '$contact_no_1'            => $register_users_model->get_contact_no_1(),
            '$contact_no_2'            => $register_users_model->get_contact_no_2(),
            '$user_type'               => $register_users_model->get_user_type(),
            '$profile_pic'             => $register_users_model->get_profile_pic(),
            '$password'                => $register_users_model->get_password(),
            '$account_activation_code' => $register_users_model->get_account_activation_code(),
            '$updated_date'            => $register_users_model->get_updated_date(),
            '$updated_by'              => $register_users_model->get_updated_by());

        $this->db->where('id', $register_users_model->get_id());
        return $this->db->update('user', $data);
    }

    /**
     * update users profile
     * @param type $register_users_model Input model
     * @return boolean
     */
    function update_user_profile($register_users_model) {

        $data = array('name'          => $register_users_model->get_name(),
            'email'         => $register_users_model->get_email(),
            '$contact_no_1' => $register_users_model->get_contact_no_1(),
            'user_name'     => $register_users_model->get_user_name(),
            '$password'     => $register_users_model->get_password(),
            '$password'     => $register_users_model->get_password());

        $this->db->where('id', $register_users_model->get_id());
        return $this->db->update('user', $data);
    }

    /**
     * insert new registered user
     * @param object $register_users_model Input model
     * @return integer
     */
    function add_new_user_registration($register_users_model) {

        $this->db->insert('user', $register_users_model);
        return $this->db->insert_id();
    }

    /**
     * activate the user
     * @param string $email Input user email
     * @param string $token input tocken
     * @return boolean
     */
    function activate_user($email, $token) {

        $this->db->select('user.id');
        $this->db->from('user');
        $this->db->where('email', $email);
        $this->db->where('account_activation_code', $token);
        $this->db->where('is_published', '0');
        $query = $this->db->get();
        $user  = $query->row();

        if (!empty($user)) {
            $data = array('is_published' => '1', 'account_activation_code' => 'NULL');
            $this->db->where('id', $user->id);
            $this->db->update('user', $data);
            return true;
        } else {
            return false;
        }
    }

}
