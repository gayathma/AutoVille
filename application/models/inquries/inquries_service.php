<?php

class Inquries_service extends CI_Model{
    
    function __construct() {
        parent::__construct();
        $this->load->model('inquries/inquries_model');
    }
    
    function add_inquries($inquries) {
        return $this->db->insert('inqurie', $inquries);
    }
    
}

