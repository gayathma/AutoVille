<?php

class Vehicle_likes_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_likes/vehicle_likes_model');
    }

    /**
     * insert vehicle like record into vehicle_likes table
     * @param type $vehicle_likes_model
     * @return type
     */
    function insert_vehicle_like($vehicle_likes_model) {
        return $this->db->insert('vehicle_likes', $vehicle_likes_model);
    }

    /**
     * get vehicle like count from table for a given vehicle id
     * @param type $vehicle_id
     * @return type
     */
    function get_like_count($vehicle_id) {

        $this->db->select('vehicle_likes.id,count(vehicle_likes.id) as like_count');
        $this->db->from('vehicle_likes');
        $this->db->where('vehicle_likes.vehicle_id', $vehicle_id);
        $query = $this->db->get();
        return $query->row();
    }

}
