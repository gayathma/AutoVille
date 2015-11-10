<?php

class Vehicle_dislikes_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_dislikes/vehicle_dislikes_model');
    }

    /**
     * insert vehicle dislike record into vehicle_dislikes table
     * @param type $vehicle_dislikes_model
     * @return type
     */
    function insert_vehicle_dislike($vehicle_dislikes_model) {
        return $this->db->insert('vehicle_dislikes', $vehicle_dislikes_model);
    }

    /**
     * get vehicle dislike count from table for a given vehicle id
     * @param type $vehicle_id
     * @return type
     */
    function get_dislike_count($vehicle_id) {

        $this->db->select('vehicle_dislikes.id,count(vehicle_dislikes.id) as dislike_count');
        $this->db->from('vehicle_dislikes');
        $this->db->where('vehicle_dislikes.vehicle_id', $vehicle_id);
        $query = $this->db->get();
        return $query->row();
    }

}
