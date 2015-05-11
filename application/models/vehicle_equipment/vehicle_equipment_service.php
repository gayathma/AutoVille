<?php

class Vehicle_equipment_service extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('vehicle_equipment/vehicle_equipment_model');
    }

     /*
     * Insert data into equipment table
     */
    function add_new_vehicle_equipment($vehicle_equipment_model) {
        return $this->db->insert('vehicle_equipment', $vehicle_equipment_model);
    }
    
    /*
     * get all equipments for a particular vehicle 
     */
    function get_equipments_by_vehicle_id($vehicle_id) {
        $this->db->select('*');
        $this->db->from('vehicle_equipment');
        $this->db->where("vehicle_id", $vehicle_id);
        $query = $this->db->get();

        return $query->result();
    }
    
    /*
     * delete equipment for vehicle advertisement
     */
    function remove_equipments_for_vehicle_add($vehicle_advertisement_id){
        return $this->db->delete('vehicle_equipment', array('equipment_id' => $vehicle_advertisement_id)); 
    }
    

}
