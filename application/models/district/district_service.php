<?php

class District_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('district/district_model');
    }

    /**
     * This is the service function to get all districts
     */
    function get_all_districts() {
        $this->db->select('district.*');
        $this->db->from('district');
        $query = $this->db->get();
        return $query->result();
    }

}
