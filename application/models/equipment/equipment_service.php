<?php

class Equipment_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('equipment/equipment_model');
    }

    function get_all_active_equipment() {
        $this->db->select('equipment.*');
        $this->db->from('equipment');
        $this->db->where('equipment.is_published', '1');
        $this->db->where('equipment.is_deleted', '0');
        $this->db->order_by('equipment.name', 'asc');
        $query = $this->db->get();
        return $query->result();
    }

    function get_equipment_by_id($equipment_model) {

        $query = $this->db->get_where('equipment', array('id' => $equipment_model->get_id(), 'is_deleted' => '0'));
        return $query->row();
    }

    function get_equiments_in_vehicle($vehicle_id){
        
        $this->db->select('equipment.name,');
        $this->db->from('equipment');
        $this->db->join('vehicle_equipment','vehicle_equipment.equipment_id=equipment.id');
        $this->db->join('vehicle_compare','vehicle_compare.vehicle_id=vehicle_equipment.vehicle_id');
        $this->db->where('vehicle_compare.vehicle_id',$vehicle_id);
        $query = $this->db->get(); 
        //echo $this->db->last_query();
        //die;
        return $query->result();
    }
}
