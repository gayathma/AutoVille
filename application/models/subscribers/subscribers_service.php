<?php

class Subscribers_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('subscribers/subscribers_model');
    }

    /*
     * save subscribers inside database
     */
    function add_subscribers($subscribers_model) {
        return $this->db->insert('subscribers', $subscribers_model);
    }
    
    /*
     * get subscriber using email
     */
    function get_subscriber($email){
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row();
    }

}
