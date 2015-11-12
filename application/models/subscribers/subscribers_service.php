<?php

class Subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('subscribers/subscribers_model');
    }

    /**
     * save subscribers inside database
     * @param object $subscribers_model Input model
     * @return object
     */
    function add_subscribers($subscribers_model) {
        return $this->db->insert('subscribers', $subscribers_model);
    }

    /**
     * get subscriber using email
     * @param string $email Input email
     * @return object
     */
    function get_subscriber($email) {
        $this->db->select('*');
        $this->db->from('subscribers');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }
    
    function unsubscribe($email) {

        $this->db->select('subscribers.id');
        $this->db->from('subscribers');
        $this->db->where('email', $email);
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
