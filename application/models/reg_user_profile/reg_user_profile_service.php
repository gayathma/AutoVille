<?php

class Reg_User_Profile_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('reg_user_profile/reg_user_profile_model');
    }

    /**
     * get reg users details
     * @return object
     */
    function get_reg_user_details() {
        $this->db->select('user.*, user_type.type');
        $this->db->from('user');
        $this->db->join('user_type', 'user.user_type= user_type.id');
        $this->db->where('user_type.id in (3)');
        $this->db->where('is_deleted', '0');
        $this->db->order_by("user.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * To get all active registered users
     * @return object
     */
    function get_all_active_registered_users() {
        $this->db->select('user.*');
        $this->db->from('user');
        $this->db->where('user_type', 3);
        $this->db->where('is_published', '1');
        $this->db->where('is_deleted', '0');
        $this->db->order_by("user.added_date", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * To get registered user details by passing id as a parameter
     * @param object $reg_user_profile_model Input model
     * @return object
     */
    function get_reg_user_by_id($reg_user_profile_model) {

        $this->db->select('user.*, user_type.type');
        $this->db->from('user');
        $this->db->join('user_type', 'user.user_type= user_type.id');
        $this->db->where('user.is_deleted', '0');
        $this->db->where('user.id', $reg_user_profile_model->get_id());
        $query = $this->db->get();

        return $query->row();
    }

    /**
     * delete register user profile
     * @param integer $user_id Input user id
     * @return boolean
     */
    function delete_reg_user_profile($user_id) {
        $data = array('is_deleted' => '1');
        $this->db->where('id', $user_id);
        return $this->db->update('user', $data);
    }

    /**
     * update register user
     * @param string $user Input user name
     * @param array $data Input user details
     * @return boolean
     */
    function update_reg_user($user, $data) {

        $this->db->where('user_name', $user);
        return $this->db->update('user', $data);
    }

    /**
     * add user profile
     * @param object $reg_user_profile_model Input model
     * @return boolean
     */
    function add_user_profile($reg_user_profile_model) {
        return $this->db->insert('user', $reg_user_profile_model);
    }

    /**
     * update password and avatar of a registered user 
     * @param object $reg_user_profile_model Input model
     * @return boolean
     */
    function update_password_and_avatar($reg_user_profile_model) {
        $data = array('password'     => $reg_user_profile_model->get_password(),
            'profile_pic'  => $reg_user_profile_model->get_profile_pic(),
            'updated_by'   => $reg_user_profile_model->get_updated_by(),
            'updated_date' => $reg_user_profile_model->get_updated_date());
        $this->db->where('id', $reg_user_profile_model->get_id());
        return $this->db->update('user', $data);
    }

}
