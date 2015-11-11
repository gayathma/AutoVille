<?php

class Transmission_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('transmission/transmission_model');
    }

    /**
     * This is the service function to get all transmissions
     * @return object
     */
    public function get_all_active_transmissions() {

        $this->db->select('transmission.*');
        $this->db->from('transmission');
        $this->db->where('transmission.is_deleted', '0');
        $this->db->where('transmission.is_published', '1');
        $this->db->order_by("transmission.name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This is the service function to get transmission detail by  passing the 
     * @param object $transmission_model Input model
     * @return object
     */
    function get_transmission_by_id($transmission_model) {

        $query = $this->db->get_where('transmission', array('id' => $transmission_model->get_id(), 'is_deleted' => '0'));
        return $query->row();
    }

}
