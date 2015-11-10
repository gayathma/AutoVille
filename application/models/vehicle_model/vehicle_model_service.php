<?php

class Vehicle_model_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_model/vehicle_model_model');
    }

    /**
     * This is the service function to get all vehicle models
     */
    public function get_all_active_vehicle_models() {

        $this->db->select('model.*');
        $this->db->from('model');
        $this->db->where('model.is_published', '1');
        $this->db->where('model.is_deleted', '0');
        $this->db->order_by("model.name", "asc");
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This is the service function to get vehicle model by model id passing the 
     * id as a parameter
     * @param object $vehicle_model_model Input model
     * @return object
     */
    function get_vehicle_model_by_id($vehicle_model_model) {

        $query = $this->db->get_where('model', array('id' => $vehicle_model_model->get_id(), 'is_deleted' => '0'));
        return $query->row();
    }

    /**
     * This is the service function to get vehicle model by manufacture id passing the 
     * manufacture id as a parameter
     * @param integer $manufacture_id Input manufacturer id
     * @return object
     */
    function get_vehicle_model_by_manufacture($manufacture_id) {

        $query = $this->db->get_where('model', array('manufacturer_id' => $manufacture_id, 'is_deleted' => '0', 'is_published' => '1'));
        return $query->result();
    }

}
