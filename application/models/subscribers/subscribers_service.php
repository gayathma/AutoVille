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
    
    /**
     * unsubscribe the user
     * @param string $email Input email
     * @return boolean
     */
    function unsubscribe($email) {

        $this->db->select('subscribers.id');
        $this->db->from('subscribers');
        $this->db->where('email', $email);
        $this->db->where('status', '1');
        $query = $this->db->get();
        $subscriber  = $query->row();

        if (!empty($subscriber)) {
            $data = array('status' => '0');
            $this->db->where('id', $subscriber->id);
            $this->db->update('subscribers', $data);
            return true;
        } else {
            return false;
        }
    }

}
