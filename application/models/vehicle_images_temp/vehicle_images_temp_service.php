<?php

class Vehicle_images_temp_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_images_temp/vehicle_images_temp_model');
    }

    /**
     * get all temp images for one user
     */
    public function get_all_temp_images_for_user($user_id) {

        $this->db->select('*');
        $this->db->from('vehicle_images_temp');
        $this->db->where('added_by', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Insert data into temp images table
     * @param object $vehicle_images_temp_model Input model
     * @return boolean
     */
    function add_new_temp_images($vehicle_images_temp_model) {
        return $this->db->insert('vehicle_images_temp', $vehicle_images_temp_model);
    }

    /**
     * Truncate the whole temp images table
     */
    function truncate_temp_images() {
        return $this->db->truncate('vehicle_images_temp');
    }

}
