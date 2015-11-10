<?php

class Inquries_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('inquries/inquries_model');
    }

    /**
     * save inquiry inside database
     * @param object $inquries Input model
     * @return boolean
     */
    function add_inquries($inquries) {
        return $this->db->insert('inqurie', $inquries);
    }

}
